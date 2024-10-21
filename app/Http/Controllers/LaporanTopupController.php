<?php

namespace App\Http\Controllers;

use App\Models\UserWallet;
use Yajra\DataTables\Facades\DataTables;

class LaporanTopupController extends Controller
{

    public function get_data_json() {
        $data = UserWallet::get();
        return DataTables::of($data)
            ->addColumn('user', function($data) {
                return '<div class="d-flex align-items-center gap-2">
                    <div class="avatar-md bg-opacity-10 rounded">
                        <img src="' . $data->user->thumbnail . '" alt="avatar" class="img-fluid rounded-circle">
                    </div>
                    <div>
                        <p class="mb-0">' . $data->user->name . '</p>
                        <p class="mb-0">' . $data->user->email . '</p>
                    </div>
                </div>';
            })
            ->addColumn('kode_transaksi', function($data) {
                return '<p class="mb-0">' . $data->kode_transaksi . '</p>';
            })
            ->addColumn('tanggal', function($data) {
                return '<p class="mb-0">' . $data->created_at->format('d-m-Y H:i:s') . '</p>';
            })
            ->addColumn('jenis_transaksi', function($data) {
               $html =  $data->kredit > 0 ? '<span class="badge bg-success">Transfer</span>' : '<span class="badge bg-primary">Top Up</span>';
               return $html;
            })
            ->addColumn('jumlah', function($data) {
                return '<p class="mb-0"> ' . $data->kredit > 0 ? "Rp. " . number_format($data->kredit) : "Rp. " . number_format($data->debit) . '</p>';
            })
            ->rawColumns(['user', 'kode_transaksi', 'tanggal', 'jenis_transaksi', 'jumlah'])
            ->make(true);
    }

    public function index() {
        $jumlah_transaksi = UserWallet::count();
        $jumlah_transaksi_success = UserWallet::where('status', 'success')->count();
        $jumlah_transaksi_failed = UserWallet::where('status', 'failed')->count();
        $jumlah_transaksi_pending = UserWallet::where('status', 'pending')->count();
        return view('admin.laporan.index', compact('jumlah_transaksi', 'jumlah_transaksi_success', 'jumlah_transaksi_failed', 'jumlah_transaksi_pending'));
    }
}
