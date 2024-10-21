<?php

namespace App\Http\Controllers;

use App\Exports\Transaksi;
use App\Exports\UsersExport;
use App\Models\DetailTransaction;
use App\Models\Merchant;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Maatwebsite\Excel\Facades\Excel;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class HistoryController extends Controller
{
    public function history_page(Request $request)
    {
        if($request->startDate && $request->endDate) {
            $transactions = Transaction::where('user_id', Auth::user()->id)->orWhere('buyer_id', Auth::user()->id)->whereBetween('created_at', [$request->startDate, $request->endDate])->orderBy('created_at', 'desc')->paginate(5);
            $total_income = Transaction::where('user_id', Auth::user()->id)->where('status', 'success')->whereBetween('created_at', [$request->startDate, $request->endDate])->sum('nominal');
            $total_outcome = Transaction::where('user_id', Auth::user()->id)->where('status', 'success')->whereBetween('created_at', [$request->startDate, $request->endDate])->sum('nominal');
        } else {
            $transactions = Transaction::where('user_id', Auth::user()->id)->orWhere('buyer_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(5);
            $total_income = Transaction::where('user_id', Auth::user()->id)->where('status', 'success')->whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->sum('nominal');
            $total_outcome = Transaction::where('user_id', Auth::user()->id)->where('status', 'success')->whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->sum('nominal');
        }
        return view('pengguna.history.index', compact('transactions', 'total_income', 'total_outcome'));
    }

    // download excel
    public function download_excel(Request $request)
    {
        $query = Transaction::where(function($q) {
            $q->where('user_id', Auth::user()->id)
              ->orWhere('buyer_id', Auth::user()->id);
        });

        if ($request->startDate && $request->endDate) {
            $query->whereBetween('created_at', [$request->startDate, $request->endDate]);
        }

        $transactions = $query->orderBy('created_at', 'desc')->get();

        return Excel::download(new UsersExport($transactions), 'transactions.xlsx');
    }

    public function export_excel(Request $request)
    {
        $startDate = $request->query('startDate');
        $endDate = $request->query('endDate');

        $query = Transaction::where(function($q) {
            $q->where('user_id', Auth::user()->id)
              ->orWhere('buyer_id', Auth::user()->id);
        });

        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        $transactions = $query->orderBy('created_at', 'desc')->get();

        $data = [];
        foreach ($transactions as $transaction) {
            $detail_transactions = $transaction->detailTransactions;
            foreach ($detail_transactions as $detail) {
                $product = $detail->product;
                $data[] = [
                    'title' => $product->title,
                    'quantity' => $detail->quantity,
                    'price' => ($product->price),
                    'sale_price' => $product->sale_price,
                    'profit' => ($product->sale_price - $product->price) * $detail->quantity,
                    'total' => $product->sale_price * $detail->quantity
                ];
            }
        }
        array_push($data, [
            'title' => 'Total',
            'quantity' => array_sum(array_column($data, 'quantity')),
            'price' => array_sum(array_column($data, 'price')),
            'sale_price' => array_sum(array_column($data, 'sale_price')),
            'profit' => array_sum(array_column($data, 'profit')),
            'total' => array_sum(array_column($data, 'total'))
        ]);
        $result = [];
        for($a = 0; $a < count($data); $a++) {
            $result[] = [
                'title' => $data[$a]['title'],
                'quantity' => $data[$a]['quantity'],
                'price' => 'Rp. ' . number_format($data[$a]['price']),
                'sale_price' => 'Rp. ' . number_format($data[$a]['sale_price']),
                'profit' => 'Rp. ' . number_format($data[$a]['profit']),
                'total' => 'Rp. ' . number_format($data[$a]['total'])
            ];
        }
        return Excel::download(new Transaksi($result), 'transactions.xlsx');
    }

    public function history_detail_page($id)
    {
        $history_id = Crypt::decryptString($id);
        $transaction = Transaction::find($history_id);
        $merchant = Merchant::find($transaction->merchant_id);
        $transaction_detail = DetailTransaction::where('transaction_id', $transaction->id)->get();
        $buyer = User::where('id', $transaction->buyer_id)->first();
        $data = [
            'kode_transaksi' => $transaction->kode_transaksi,
            'user_code' => $transaction->user->user_code,
        ];
        $qrCode = QrCode::format('svg')->size(250)->generate(json_encode($data));
        return view('pengguna.history.detail', compact('transaction', 'merchant', 'transaction_detail', 'buyer', 'qrCode'));
    }

    public function history_detail_print($id)
    {
        $history_id = Crypt::decryptString($id);
        $transaction = Transaction::find($history_id);
        $merchant = Merchant::find($transaction->merchant_id);
        $transaction_detail = DetailTransaction::where('transaction_id', $transaction->id)->get();
        $buyer = User::where('id', $transaction->buyer_id)->first();
        $data = [
            'kode_transaksi' => $transaction->kode_transaksi,
            'user_code' => $transaction->user->user_code,
        ];
        $qrCode = QrCode::format('svg')->size(250)->generate(json_encode($data));
        return view('pengguna.history.detail_print', compact('transaction', 'merchant', 'transaction_detail', 'buyer', 'qrCode'));
    }
}
