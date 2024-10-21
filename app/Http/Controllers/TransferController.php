<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Models\Admin;
use App\Models\AdminNotification;
use App\Models\BankAdmin;
use App\Models\Notification;
use App\Models\Saldo;
use App\Models\Transfer;
use App\Models\User;
use App\Models\UserWallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Pusher\Pusher;
use Pusher\PushNotifications\PushNotifications;
use Yajra\DataTables\Facades\DataTables;

class TransferController extends Controller
{
    public function get_data()
    {
        $transfer = Transfer::with('saldo')->query();
        return DataTables::of($transfer)
            ->addColumn('action', function ($row) {
                return '<a href="javascript:void(0)" class="edit btn btn-primary">View</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $transfer = Transfer::create($request->all());
        return response()->json(['message' => 'Transfer berhasil']);
    }

    public function update(Request $request, $id)
    {
        $transfer = Transfer::find($id);
        $transfer->update($request->all());
        return response()->json(['message' => 'Transfer berhasil']);
    }

    public function destroy($id)
    {
        $transfer = Transfer::find($id);
        $transfer->delete();
        return response()->json(['message' => 'Transfer berhasil']);
    }

    public function topup_page()
    {
        $bank = BankAdmin::all();
        return view('pengguna.topup.index', compact('bank'));
    }

    public function topup(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->all();
            $data['user_id'] = Auth::user()->id;
            $saldo = Saldo::where('user_id', Auth::user()->id)->first();
            if (!Hash::check($request->pin, $saldo->pin)) {
                return redirect()->back()->with('error', 'PIN salah');
            }
            $data['debit'] = $saldo->saldo + str_replace('.', '', $request->saldo);
            $data['type'] = 'debit';
            $data['saldo'] = $saldo->saldo;
            $data['kode_transaksi'] = 'TRX-' . time();
            $data['kredit'] = 0;
            $kode_bank = BankAdmin::where('id', $request->bank)->first();
            $data['kode_bank'] = $kode_bank->bank_account_number;
            $data['rekening'] = $kode_bank->rekening;
            $data['rekening_pengirim'] = $request->rekening_pengirim;
            $data['nama'] = $kode_bank->bank_account_name;
            $fileName = null;
            if ($request->hasFile('bukti_pembayaran')) {
                $file = $request->file('bukti_pembayaran');
                $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('bukti_pembayaran', $file, $fileName);
                $data['bukti_pembayaran'] = env('APP_URL') . '/storage/bukti_pembayaran/' . $fileName;
            }
            $data['status'] = 'pending';
            UserWallet::create($data);
            $beamsClient = new PushNotifications([
                'instanceId' => env('PUSHER_BEAMS_INSTANCE_ID'),
                'secretKey' => env('PUSHER_BEAMS_SECRET_KEY'),
            ]);

            $publishResponse = $beamsClient->publishToInterests(
                ['transaksi-update'],
                [
                    'web' => [
                        'notification' => [
                            'title' => 'Topup Berhasil',
                            'body' => 'Transaksi topup anda dengan kode transaksi ' . $data['kode_transaksi'] . ' telah berhasil',
                        ],
                    ],
                ]
            );
            $admin = Admin::all();
            foreach ($admin as $a) {
                AdminNotification::create([
                    'admin_id' => $a->id,
                    'title' => 'Topup Berhasil',
                    'url' => route('Topup Success Page'),
                    'thumbnail' => 'https://cdn-icons-png.flaticon.com/512/61/61457.png',
                    'content' => 'Terdapat topup baru dengan kode transaksi ' . $data['kode_transaksi'] . ' dengan nominal ' . number_format($request->saldo, 0, ',', '.') . ' dari ' . $data['nama'],
                    'is_read' => false,
                ]);
            }
            // publish to admin pusher

            $options = [
                'cluster' => env('PUSHER_APP_CLUSTER'),
                'useTLS' => true,
            ];

            $pusher = new Pusher(env('PUSHER_APP_KEY'), env('PUSHER_APP_SECRET'), env('PUSHER_APP_ID'), $options);
            $pusher->trigger('transaksi-update', 'transaksi-update', 'success');
            DB::commit();
            return redirect()->route('Topup Success Page')->with('success', 'Rp. ' . $request->saldo);
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function error_page()
    {
        return view('pengguna.topup.error');
    }

    public function success_page()
    {
        return view('pengguna.topup.success');
    }

    public function get_data_topup()
    {
        $topup = UserWallet::where('status', 'pending')->where('debit', '!=', 0)->get();
        return DataTables::of($topup)
            ->addColumn('action', function ($row) {
                return '<button type="button" class="edit btn btn-primary" data-bs-toggle="modal" data-bs-target="#status-view" onclick="view_bukti(\'' . $row->bukti_pembayaran . '\', \'' . $row->id . '\')">View</button>';
            })
            ->editColumn('saldo', function ($row) {
                return 'Rp. ' . number_format($row->saldo, 0, ',', '.');
            })
            ->editColumn('kredit', function ($row) {
                return 'Rp. ' . number_format($row->kredit, 0, ',', '.');
            })
            ->editColumn('debit', function ($row) {
                return 'Rp. ' . number_format($row->debit, 0, ',', '.');
            })
            ->editColumn('status', function ($row) {
                if ($row->status == 'pending') {
                    return '<span class="badge bg-warning">Pending</span>';
                } else if ($row->status == 'success') {
                    return '<span class="badge bg-success">Success</span>';
                } else {
                    return '<span class="badge bg-danger">Failed</span>';
                }
            })
            ->editColumn('created_at', function ($row) {
                return date('d F Y H:i:s', strtotime($row->created_at));
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }

    public function get_data_penarikan()
    {
        $penarikan = UserWallet::where('status', 'pending')->where('kredit', '!=', 0)->get();
        return DataTables::of($penarikan)
            ->addColumn('action', function ($row) {
                return '<a href="javascript:void(0)" class="edit btn btn-primary">View</a>';
            })
            ->editColumn('saldo', function ($row) {
                return 'Rp. ' . number_format($row->saldo, 0, ',', '.');
            })
            ->editColumn('created_at', function ($row) {
                return date('d F Y H:i:s', strtotime($row->created_at));
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function tolak_topup($id, Request $request)
    {
        DB::beginTransaction();
        try {
            $topup = UserWallet::find($id);
            $topup->update(['status' => 'rejected', 'keterangan' => $request->alasan]);
            Notification::create([
                'user_id' => $topup->user_id,
                'title' => 'Topup Ditolak',
                'url' => route('Topup History Page'),
                'thumbnail' => 'https://cdn-icons-png.flaticon.com/512/61/61457.png',
                'content' => 'Transaksi topup anda dengan kode transaksi ' . $topup->kode_transaksi . ' telah ditolak, sebab ' . $request->alasan,
                'is_read' => false,
            ]);

            $beamsClient = new PushNotifications([
                'instanceId' => env('PUSHER_BEAMS_INSTANCE_ID'),
                'secretKey' => env('PUSHER_BEAMS_SECRET_KEY'),
            ]);

            $publishResponse = $beamsClient->publishToInterests(
                ['transaksi-update'],
                [
                    'web' => [
                        'notification' => [
                            'title' => 'Topup Ditolak',
                            'body' => 'Transaksi topup anda dengan kode transaksi ' . $topup->kode_transaksi . ' telah ditolak, sebab ' . $request->alasan,
                        ],
                    ],
                ]
            );
            DB::commit();
            return response()->json(['message' => 'Topup berhasil ditolak']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['message' => $th->getMessage()]);
        }
    }

    public function setujui_topup($id)
    {
        DB::beginTransaction();
        try {
            $topup = UserWallet::find($id);
            $saldo = Saldo::where('user_id', $topup->user_id)->first();
            $topup->update(['saldo' => $saldo->saldo + $topup->debit, 'status' => 'success']);
            $topup = UserWallet::find($id);
            $saldo->update(['saldo' => $topup->saldo]);

            $beamsClient = new PushNotifications([
                'instanceId' => env('PUSHER_BEAMS_INSTANCE_ID'),
                'secretKey' => env('PUSHER_BEAMS_SECRET_KEY'),
            ]);

            $publishResponse = $beamsClient->publishToInterests(
                ['transaksi-update'],
                [
                    'web' => [
                        'notification' => [
                            'title' => 'Topup Disetujui',
                            'body' => 'Transaksi topup anda dengan kode transaksi ' . $topup->kode_transaksi . ' telah disetujui',
                        ],
                    ],
                ]
            );
            $admin = Admin::all();
            foreach ($admin as $a) {
                Notification::create([
                    'user_id' => $a->id,
                    'title' => 'Topup Disetujui',
                    'url' => route('Topup History Page'),
                    'thumbnail' => 'https://cdn-icons-png.flaticon.com/512/61/61457.png',
                    'content' => 'Transaksi topup anda dengan kode transaksi ' . $topup->kode_transaksi . ' telah disetujui',
                    'is_read' => false,
                ]);
            }

            $this->publish_notify();

            DB::commit();
            return response()->json(['message' => 'Topup berhasil disetujui']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['message' => $th->getMessage()]);
        }
    }

    public function publish_notify() {
        $options = [
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'useTLS' => true,
        ];

        $pusher = new Pusher(env('PUSHER_APP_KEY'), env('PUSHER_APP_SECRET'), env('PUSHER_APP_ID'), $options);
        $pusher->trigger('transaksi-update', 'transaksi-update', 'success');
    }


    public function get_data_topup_admin()
    {
        return view('admin.topup.index');
    }

    public function get_data_transfer_admin_json()
    {
        $data = UserWallet::where('status', 'pending')->where('kredit', '!=', 0)->where('kode_bank', '!=', 'ByLa')->get();
        return DataTables::of($data)
            ->addColumn('pengguna', function ($row) {
                return '<div class="d-flex align-items-center gap-2"><img src="' . $row->user->thumbnail . '" class="rounded-circle" width="50" height="50"> <span>' . $row->user->name . '</span></div>';
            })
            ->editColumn('kode_transaksi', function ($row) {
                return $row->kode_transaksi;
            })
            ->editColumn('rekening', function ($row) {
                return $row->rekening;
            })
            ->editColumn('nama', function ($row) {
                return $row->nama;
            })
            ->editColumn('kredit', function ($row) {
                return 'Rp. ' . number_format($row->kredit, 0, ',', '.');
            })
            ->editColumn('status', function ($row) {
                if ($row->status == 'pending') {
                    return '<span class="badge bg-warning">Pending</span>';
                } else if ($row->status == 'success') {
                    return '<span class="badge bg-success">Success</span>';
                } else {
                    return '<span class="badge bg-danger">Failed</span>';
                }
            })
            ->addColumn('action', function ($row) {
                return '<button type="button" class="btn btn-danger" onclick="tolak_penarikan(\'' . $row->id . '\')">Tolak</button> <button type="button" class="btn btn-success" onclick="setujui_penarikan(\'' . $row->id . '\')">Setujui</button>';
            })
            ->editColumn('created_at', function ($row) {
                return date('d F Y H:i:s', strtotime($row->created_at));
            })
            ->rawColumns(['action', 'pengguna', 'status'])
            ->make(true);
    }

    public function disetujui_transfer(Request $request) {
        DB::beginTransaction();
        try {
            $transfer = UserWallet::find($request->id);
            $saldo = Saldo::where('user_id', $transfer->user_id)->first();
            $saldo->update(['saldo' => $saldo->saldo + $transfer->kredit]);
            $transfer->update(['status' => 'success']);
            DB::commit();
            // kirim notifikasi ke pengguna
            $beamsClient = new PushNotifications([
                'instanceId' => env('PUSHER_BEAMS_INSTANCE_ID'),
                'secretKey' => env('PUSHER_BEAMS_SECRET_KEY'),
            ]);

            $publishResponse = $beamsClient->publishToInterests(
                ['transaksi-update'],
                [
                    'web' => [
                        'notification' => [
                            'title' => 'Transfer Disetujui',
                            'body' => 'Transaksi transfer anda dengan kode transaksi ' . $transfer->kode_transaksi . ' telah disetujui',
                        ],
                    ],
                ]
            );

            Notification::create([
                'user_id' => $transfer->user_id,
                'title' => 'Transfer Disetujui',
                'url' => route('Topup History Page'),
                'thumbnail' => 'https://cdn-icons-png.flaticon.com/512/61/61457.png',
                'content' => 'Transaksi transfer anda dengan kode transaksi ' . $transfer->kode_transaksi . ' telah disetujui',
                'is_read' => false,
            ]);

            return response()->json(['message' => 'Transfer berhasil disetujui']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['message' => $th->getMessage()]);
        }
    }

    public function ditolak_transfer(Request $request) {
        DB::beginTransaction();
        try {
            $transfer = UserWallet::find($request->id);
            $transfer->update(['status' => 'rejected', 'keterangan' => $request->alasan]);
            DB::commit();
            // kirim notifikasi ke pengguna
            $beamsClient = new PushNotifications([
                'instanceId' => env('PUSHER_BEAMS_INSTANCE_ID'),
                'secretKey' => env('PUSHER_BEAMS_SECRET_KEY'),
            ]);
            $publishResponse = $beamsClient->publishToInterests(
                ['transaksi-update'],
                [
                    'web' => [
                        'notification' => [
                            'title' => 'Transfer Ditolak',
                            'body' => 'Transaksi transfer anda dengan kode transaksi ' . $transfer->kode_transaksi . ' telah ditolak, sebab ' . $request->alasan,
                        ],
                    ],
                ]
            );

            Notification::create([
                'user_id' => $transfer->user_id,
                'title' => 'Transfer Ditolak',
                'url' => route('Topup History Page'),
                'thumbnail' => 'https://cdn-icons-png.flaticon.com/512/61/61457.png',
                'content' => 'Transaksi transfer anda dengan kode transaksi ' . $transfer->kode_transaksi . ' telah ditolak, sebab ' . $request->alasan,
                'is_read' => false,
            ]);

            return redirect()->route('Transfer Page')->with('success', 'Transfer berhasil ditolak');
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['message' => $th->getMessage()]);
        }
    }

    public function get_data_transfer_admin()
    {
        return view('admin.transfer.index');
    }

    public function transfer_qr_page()
    {
        return view('pengguna.transfer.transfer');
    }

    public function transfer_qr(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->all();
            $saldo = Saldo::where('user_id', Auth::user()->id)->first();
            if (!Hash::check($request->pin, $saldo->pin)) {
                return redirect()->back()->with('error', 'PIN salah');
            }
            if ($saldo->saldo < $request->nominal) {
                return redirect()->back()->with('error', 'Saldo tidak cukup');
            }
            $data['user_id'] = Auth::user()->id;
            $data['kode_transaksi'] = 'TRX-' . time();
            $data['kredit'] = $request->nominal;
            $data['debit'] = 0;
            $data['status'] = 'success';
            $data['type'] = 'kredit';
            $data['rekening_pengirim'] = Auth::user()->user_code;
            $data['kode_bank'] = 'ByLa';
            $data['nama'] = Auth::user()->name;
            $data['saldo'] = $saldo->saldo - $request->nominal;
            UserWallet::create($data);
            $saldo->update(['saldo' => $data['saldo']]);
            $beamsClient = new PushNotifications([
                'instanceId' => env('PUSHER_BEAMS_INSTANCE_ID'),
                'secretKey' => env('PUSHER_BEAMS_SECRET_KEY'),
            ]);

            $publishResponse = $beamsClient->publishToInterests(
                ['transaksi-update'],
                [
                    'web' => [
                        'notification' => [
                            'title' => 'Transfer Berhasil',
                            'body' => 'Transaksi transfer anda dengan kode transaksi ' . $data['kode_transaksi'] . ' telah berhasil',
                        ],
                    ],
                ]
            );


            $user_penerima = User::where('user_code', $request->kode_user)->first();
            $saldo_penerima = Saldo::where('user_id', $user_penerima->id)->first();
            $saldo_penerima->update(['saldo' => $saldo_penerima->saldo + $request->nominal]);

            $transaction2 = [
                'user_id' => $user_penerima->id,
                'kode_transaksi' => $data['kode_transaksi'] . time(),
                'kredit' => 0,
                'debit' => $request->nominal,
                'status' => 'success',
                'type' => 'debit',
                'rekening_pengirim' => Auth::user()->user_code,
                'kode_bank' => 'ByLa',
                'nama' => Auth::user()->name,
                'saldo' => $saldo_penerima->saldo,
            ];
            UserWallet::create($transaction2);

            DB::commit();
            return redirect()->route('Transfer QR Page')->with('success', 'Transfer berhasil');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function transfer_history(Request $request)
    {
        if($request->startDate && $request->endDate) {
            $transactions = UserWallet::where('user_id', Auth::user()->id)->whereBetween('created_at', [$request->startDate, $request->endDate])->paginate(10);
            $total_outcome = UserWallet::where('user_id', Auth::user()->id)
            ->where('status', 'success')
            ->whereBetween('created_at', [$request->startDate, $request->endDate])->sum('kredit');
            $total_income = UserWallet::where('user_id', Auth::user()->id)
            ->where('status', 'success')
            ->whereBetween('created_at', [$request->startDate, $request->endDate])->sum('debit');
        } else {
            $transactions = UserWallet::where('user_id', Auth::user()->id)->paginate(10);
            $total_outcome = UserWallet::where('user_id', Auth::user()->id)->where('status', 'success')->sum('kredit');
            $total_income = UserWallet::where('user_id', Auth::user()->id)->where('status', 'success')->sum('debit');
        }
        return view('pengguna.transfer.history', compact('transactions', 'total_outcome', 'total_income'));
    }

    public function download_excel(Request $request)
    {
        return Excel::download(new UsersExport($request), 'transactions.xlsx');
    }
}
