<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaction;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserWallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class TransactionController extends Controller
{
    public function admin_index()
    {
        return view('admin.transaction.index');
    }

    public function admin_get_data_json()
    {
        $data = Transaction::query();
        return DataTables::of($data)
            ->addColumn('user', function ($data) {
                $html = '<div class="d-flex align-items-center">';
                $html .= '<img src="' . $data->user->thumbnail . '" class="rounded-circle" width="50" height="50">';
                $html .= '<div class="ms-3">';
                $html .= '<p class="fw-bold mb-0">' . $data->user->name . '</p>';
                $html .= '</div></div>';
                return $html;
            })
            ->addColumn('merchant', function ($data) {
                return '<span class="badge bg-primary">' . $data->merchant->name . '</span>';
            })
            ->addColumn('buyer', function ($data) {
                return '<span class="badge bg-primary">' . $data->buyer->name . '</span>';
            })
            ->editColumn('status', function ($data) {
                if ($data->status == 'success') {
                    return '<span class="badge bg-success">' . $data->status . '</span>';
                } else if ($data->status == 'pending') {
                    return '<span class="badge bg-warning">' . $data->status . '</span>';
                } else if ($data->status == 'failed') {
                    return '<span class="badge bg-danger">' . $data->status . '</span>';
                }
            })
            ->editColumn('created_at', function ($data) {
                return date('d F Y H:i', strtotime($data->created_at));
            })
            ->addColumn('action', function ($data) {
                return '<a href="' . route('admin.transactions.detail', $data->id) . '" class="btn btn-primary btn-sm">Detail</a>';
            })
            ->rawColumns(['user', 'merchant', 'buyer', 'action'])
            ->make(true);
    }

    public function admin_detail($id)
    {
        $data = Transaction::with(['user', 'merchant', 'buyer', 'detail'])->find($id);
        return view('admin.transaction.detail', compact('data'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $transaction = Transaction::create([
                'user_id' => $request->user_id,
                'merchant_id' => $request->merchant_id,
                'status' => $request->status,
                'nominal' => $request->nominal,
                'expired_at' => now()->addMinutes(10),
            ]);

            $transaction_detail = $request->transactions;

            foreach ($transaction_detail as $transaction_detail) {
                DetailTransaction::create([
                    'transaction_id' => $transaction->id,
                    'kode_produk' => $transaction_detail['kode_produk'],
                    'title' => $transaction_detail['title'],
                    'description' => $transaction_detail['description'],
                    'nominal' => $transaction_detail['nominal'],
                    'quantity' => $transaction_detail['quantity'],
                ]);
            }
            
            DB::commit();
            return response()->json(['message' => 'Transaksi berhasil dibuat']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

    public function payment(Request $request)
    {
        try {
            DB::beginTransaction();
            $transaction = Transaction::where('kode_transaksi', $request->kode_transaksi)->first();
            $transaction->update([
                'status' => 'success',
                'buyer_id' => $request->buyer_id,
            ]);
            $user = User::find($transaction->buyer_id);
            $saldo = UserWallet::where('user_id', $user->id)->first();
            $saldo->decrement('balance', $transaction->nominal);
            $seller = User::find($transaction->user_id);
            $sellerSaldo = UserWallet::where('user_id', $seller->id)->first();
            $sellerSaldo->increment('balance', $transaction->nominal);
            DB::commit();
            return response()->json(['message' => 'Transaksi berhasil']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['message' => $th->getMessage()], 500);
        }

    }
}
