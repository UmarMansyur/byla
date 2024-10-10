<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{

    public function get_data_json()
    {
        return DataTables::of(User::query())
            ->addColumn('thumbnail', function ($user) {
                return '<img src="' . $user->thumbnail . '" alt="thumbnail" class="avatar-sm img-fluid"/>';
            })
            ->addColumn('action', function ($user) {
                return '<div>
                <a href="javascript:void(0)" class="btn btn-sm btn-soft-warning" onclick="detail(' . $user->id . ')" data-bs-toggle="modal" data-bs-target="#modal-ganti-password">
                    <i class="bx bx-key"></i>
                </a>
                <a href="/admin/users/edit/' . $user->id . '" class="btn btn-sm btn-soft-primary">
                    <i class="bx bx-pencil"></i>
                </a>
                <a href="javascript:void(0)" class="btn btn-sm btn-soft-danger" onclick="destroy(' . $user->id . ')">
                    <i class="bx bx-trash"></i>
                </a>
                </div>
                ';
            })
            ->editColumn('is_active', function ($user) {
                return $user->is_active == 1 ? '<span class="badge bg-soft-success text-uppercase text-success">Aktif</span>' : '<span class="badge bg-soft-danger text-uppercase text-danger">Tidak Aktif</span>';
            })
            ->editColumn('gender', function ($user) {
                return $user->gender == 'male' ? 'Laki-laki' : 'Perempuan';
            })
            ->rawColumns(['action', 'thumbnail', 'is_active', 'gender'])
            ->make(true);
    }

    public function change_password(Request $request)
    {
        $user = User::find($request->id);
        if($request->password == '' || $request->password_confirmation == ''){
            notify()->error('Password tidak boleh kosong');
            return redirect()->back();
        }
        if($request->password != $request->password_confirmation){
            notify()->error('Password tidak sama');
            return redirect()->back();
        }
        $user->update(['password' => Hash::make($request->password)]);
        notify()->success('Password berhasil diubah');
        return redirect()->back();
    }

    public function index()
    {
        $total_user = User::count();
        $total_pengguna_perempuan = User::where('gender', 'female')->count();
        $total_pengguna_laki = User::where('gender', 'male')->count();
        return view('admin.pengguna.index', compact('total_user', 'total_pengguna_perempuan', 'total_pengguna_laki'));
    }

    public function add()
    {
        return view('admin.pengguna.add');
    }

    public function store(Request $request)
    {
        try {
            $data = $request->all();
            if ($request->hasFile('thumbnail')) {
                $imageName = time() . '.' . $request->thumbnail->getClientOriginalExtension();
                Storage::disk('public')->put('thumbnail/' . $imageName, file_get_contents($request->thumbnail));
                $data['thumbnail'] = env('APP_URL') . '/storage/thumbnail/' . $imageName;
            }
            $user_code = 'P' . rand(100, 999);
            $password = Hash::make($request->password);
            if (FacadesAuth::guard('admin')->user()) {
                $data['email_verified_at'] = now();
                $data['is_active'] = 1;
            }
            $data['user_code'] = $user_code;
            $data['password'] = $password;
            User::create($data);

            notify()->success('Pengguna berhasil ditambahkan');
            return redirect()->route('admin.users');
        } catch (\Throwable $th) {
            notify()->error($th->getMessage());
            return redirect()->back();
        }
    }

    public function edit_page($id)
    {
        $user = User::find($id);
        return view('admin.pengguna.add', compact('user'));
    }

    public function edit($id, Request $request)
    {
        try {
            $user = User::find($id);
            $data = $request->all();
            if (!$user) {
                notify()->error('Pengguna tidak ditemukan');
                return redirect()->back();
            }
            if ($request->hasFile('thumbnail')) {
                if ($user->thumbnail) {
                    $url = parse_url($user->thumbnail);
                    $path = ltrim($url['path'], '/storage/thumbnail/');
                    if (Storage::disk('public')->exists('thumbnail/' . $path)) {
                        Storage::disk('public')->delete('thumbnail/' . $path);
                    }
                }
                $imageName = time() . '.' . $request->thumbnail->getClientOriginalExtension();
                Storage::disk('public')->put('thumbnail/' . $imageName, file_get_contents($request->thumbnail));
                $data['thumbnail'] = env('APP_URL') . '/storage/thumbnail/' . $imageName;
            }
            $user->update($data);
            notify()->success('Pengguna berhasil diubah');
            return redirect()->back();
        } catch (\Throwable $th) {
            notify()->error($th->getMessage());
            return redirect()->back();
        }
    }

    public function hapus($id)
    {
        $user = User::find($id);
        if ($user->thumbnail) {
            $url = parse_url($user->thumbnail);
            $path = ltrim($url['path'], '/storage/thumbnail/');
            if (Storage::disk('public')->exists('thumbnail/' . $path)) {
                Storage::disk('public')->delete('thumbnail/' . $path);
            }
        }
        $user->delete();
        notify()->success('Pengguna berhasil dihapus');
        return redirect()->back();
    }
}
