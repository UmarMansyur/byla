<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaction;
use App\Models\Merchant;
use App\Models\Product;
use App\Models\Saldo;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserWallet;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Pusher\Pusher;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $existMerchant = Merchant::where('user_id', Auth::user()->id)->first();

        if (!$existMerchant) {
            return redirect()->route('Store Page')->with('error', 'Anda tidak memiliki toko');
        }

        if($existMerchant->is_verified == 0){
            return redirect()->route('Store Page')->with('error', 'Toko anda belum dikonfirmasi, silahkan tunggu konfirmasi dari admin untuk melakukan transaksi!');
        }

        if ($request->search) {
            $products = Product::where('title', 'like', '%' . $request->search . '%')->paginate(10);
        } else {
            $products = Product::where('merchant_id', $existMerchant->id)->paginate(10);
        }
        return view('pengguna.transaction.index', compact('products'));
    }

    public function bayar_page()
    {
        return view('pengguna.transaction.bayar');
    }

    public function cart(Request $request)
    {
        try {
            $carts = Product::whereIn('id', $request->product_id)->get();
            return response()->json($carts);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function bayar(Request $request)
    {
        try {
            DB::beginTransaction();
            $product_id = [];
            foreach ($request->cart as $cart) {
                $product_id[] = $cart['product_id'];
            }
            $carts = Product::whereIn('id', $product_id)->get();
            $total_price = $request->total_price;
            $carts_request = $request->cart;

            foreach ($carts as $key => $cart) {
                if (isset($carts_request[$key]['product_id']) && $carts_request[$key]['product_id'] == $cart->id) {
                    $cart->qty = $carts_request[$key]['quantity'];
                }
            }

            $transaction = Transaction::create([
                'user_id' => Auth::user()->id,
                'merchant_id' => Auth::user()->merchant->id,
                'total_price' => $total_price,
                'kode_transaksi' => 'TRX-' . time(),
                'type_transaction' => 'transaksi-bayar',
                'expired_at' => now()->addHours(1),
                'nominal' => $total_price,
                'status' => 'pending',
            ]);

            foreach ($carts as $cart) {
                DetailTransaction::create([
                    'transaction_id' => $transaction->id,
                    'kode_produk' => $cart['kode_produk'],
                    'title' => $cart['title'],
                    'description' => $cart['description'],
                    'nominal' => $cart['sale_price'],
                    'quantity' => $cart['qty'],
                ]);
            }
    
            DB::commit();
    
            $data = [
                'user_code' => Auth::user()->user_code,
                'kode_transaksi' => $transaction->kode_transaksi,
            ];

            $qrcode = QrCode::size(350)->generate(json_encode($data));

            return response()->json([
                'qrcode' => base64_encode($qrcode),
                'data' => $data,
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
    

    public function checkout(Request $request)
    {
        try {

            $buyer = User::where('id', Auth::user()->id)->first();

            $pin = $request->pin;

            if(!Hash::check($pin, $buyer->saldo->pin)) {
                return redirect()->route('Transaction Checkout Page', ['kode_transaksi' => $request->kode_transaksi])->with('error', 'PIN salah');
            }

            $transaction = Transaction::where('kode_transaksi', $request->kode_transaksi)->first();

            if (!$transaction) {
                return redirect()->route('Transaction Checkout Page', ['kode_transaksi' => $request->kode_transaksi])->with('error', 'Transaksi tidak ditemukan');
            }

            $saldo = Saldo::where('user_id', $transaction->user_id)->first();
            if (!$saldo) {
                return redirect()->route('Transaction Checkout Page', ['kode_transaksi' => $request->kode_transaksi])->with('error', 'Saldo tidak ditemukan');
            }

            $saldo_buyer = Saldo::where('user_id', Auth::user()->id)->first();
            if (!$saldo_buyer) {
                return redirect()->route('Transaction Checkout Page', ['kode_transaksi' => $request->kode_transaksi])->with('error', 'Saldo buyer tidak ditemukan');
            }


            if($transaction->expired_at < now()) {
                return redirect()->route('Transaction Checkout Page', ['kode_transaksi' => $request->kode_transaksi])->with('error', 'Transaksi sudah expired');
            }

            if($transaction->status == 'success') {
                return redirect()->route('Transaction Success Page', ['kode_transaksi' => $request->kode_transaksi])->with('error', 'Transaksi sudah dilakukan');
            }

            if($transaction->user_id == Auth::user()->id) {
                return redirect()->route('Transaction Checkout Page', ['kode_transaksi' => $request->kode_transaksi])->with('error', 'Anda tidak dapat melakukan transaksi pada diri sendiri');
            }

            if($saldo_buyer->saldo < $transaction->nominal) {
                return redirect()->route('Transaction Checkout Page', ['kode_transaksi' => $request->kode_transaksi])->with('error', 'Saldo tidak cukup');
            }

            DB::beginTransaction();

            $merchant = Merchant::where('id', $transaction->merchant_id)->first();

            UserWallet::create([
                'user_id' => Auth::user()->id,
                'kredit' => $transaction->nominal,
                'debit' => 0,
                'type' => 'kredit',
                'saldo' => $saldo_buyer->saldo - $transaction->nominal,
                'kode_transaksi' => $transaction->kode_transaksi,
                'kode_bank' => 'ByLa',
                'rekening' => $merchant->merchant_code,
                'status' => 'success',
                'rekening_pengirim' => Auth::user()->user_code,
                'nama' => Auth::user()->name,
            ]);

            UserWallet::create([
                'user_id' => $transaction->user_id,
                'kredit' => 0,
                'debit' => $transaction->nominal,
                'type' => 'debit',
                'saldo' => $saldo->saldo + $transaction->nominal,
                'kode_transaksi' => $transaction->kode_transaksi,
                'kode_bank' => 'ByLa',
                'rekening' => $merchant->merchant_code,
                'status' => 'success',
                'rekening_pengirim' => $merchant->merchant_code,
                'nama' => $merchant->name,
            ]);

            $saldo_buyer->saldo -= $transaction->nominal;
            $saldo_buyer->save();

            $saldo->saldo += $transaction->nominal;
            $saldo->save();

            $detail_transaction = DetailTransaction::where('transaction_id', $transaction->id)->get();

            foreach ($detail_transaction as $detail) {
                $product = Product::where('kode_produk', $detail->kode_produk)->first();
                $product->stock -= $detail->quantity;
                $product->save();
            }

            $transaction->status = 'success';
            $transaction->buyer_id = Auth::user()->id;
            $transaction->save();

            $this->publish_notify();

            DB::commit();

            return redirect()->route('Transaction Success Page', ['kode_transaksi' => $request->kode_transaksi])->with('success', 'Transaksi berhasil');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('Transaction Checkout Page', ['kode_transaksi' => $request->kode_transaksi])->with('error', $th->getMessage());
        }
    }

    public function publish_notify() {
        $options = [
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'useTLS' => true,
        ];

        $pusher = new Pusher(env('PUSHER_APP_KEY'), env('PUSHER_APP_SECRET'), env('PUSHER_APP_ID'), $options);
        $pusher->trigger('transaction', 'transaction-update', 'success');
    }

    public function transaction_page()
    {
        return view('pengguna.transaction.scan');
    }

    public function checkout_page(Request $request)
    {
        try {
            $transaction = Transaction::where('kode_transaksi', $request->query('kode_transaksi'))->first();
            if(!$transaction) {
                return redirect()->route('home')->with('error', 'Transaksi tidak ditemukan');
            }
            $kode_transaksi = $transaction->kode_transaksi;
            $total_bayar = $transaction->nominal;
            return view('pengguna.transaction.checkout', compact('kode_transaksi', 'total_bayar'));
        } catch (\Throwable $th) {
            return redirect()->route('home')->with('error', $th->getMessage());
        }
    }

    public function success_page(Request $request)
    {
        try {
            $transaction = Transaction::where('kode_transaksi', $request->query('kode_transaksi'))->first();
            if($transaction->status != 'success') {
                return redirect()->route('home')->with('error', 'Transaksi tidak ditemukan');
            }
            return view('pengguna.transaction.success', compact('transaction'));
        } catch (\Throwable $th) {
            return redirect()->route('home')->with('error', $th->getMessage());
        }
    }





}
