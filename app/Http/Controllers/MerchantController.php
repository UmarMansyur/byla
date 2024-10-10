<?php

namespace App\Http\Controllers;

use App\Models\LogModel;
use App\Models\Merchant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class MerchantController extends Controller
{
    public function get_data_json() {
        $data = Merchant::query();
        return DataTables::of($data)
        ->addColumn('user', function($data) {
            $html = '<div class="d-flex align-items-center">';
            $html.= '<img src="'.$data->user->thumbnail.'" class="rounded-circle avatar-xs" width="50" height="50">';
            $html.= '<div class="ms-3">';
            $html.= '<p class="fw-bold mb-0">'.$data->user->name.'</p>';
            $html.= '<p class="text-muted mb-0">'.$data->user->email.'</p>';
            $html.= '</div>';
            $html.= '</div>';
            return $html;
        })
        ->addColumn('action', function($data) {
            $button = '<a href="'.route('edit merchant', $data->id).'" class="btn btn-sm me-1 btn-soft-primary">
                <i class="bx bx-pencil"></i>
            </a>';
            $button .= '<a href="javascript:void(0)" onclick="destroy('.$data->id.')" class="btn btn-sm btn-soft-danger">
                <i class="bx bx-trash"></i>
            </a>';
            return $button;
        })
        ->editColumn('is_verified', function($data) {
            return $data->is_verified ? '<span class="badge bg-success">Verified</span>' : '<span class="badge bg-danger">Unverified</span>';
        })
        ->rawColumns(['action', 'is_verified', 'user'])
        ->make(true);
    }

    public function index() {
        $total_merchant = Merchant::count();
        $total_merchant_aktif = Merchant::where('is_verified', true)->count();
        $total_merchant_tidak_aktif = Merchant::where('is_verified', false)->count();
        LogModel::create([
            'user_id' => Auth::guard('admin')->user()->id,
            'activity' => 'Melihat halaman merchant',
            'description' => 'Administrator melihat halaman merchant',
        ]);
        return view('admin.merchant.index', compact('total_merchant', 'total_merchant_aktif', 'total_merchant_tidak_aktif'));
    }

    public function add_page() {
        $users = User::all();
        return view('admin.merchant.add', compact('users'));
    }

    public function add(Request $request) {
        try {
            $request->validate([
                'user_id' => 'required',
                'name' => 'required',
                'address' => 'required',
                'is_verified' => 'required',
            ]);
            $data = $request->only('user_id', 'name', 'address', 'is_verified');
            $data['merchant_code'] = 'MCH' . str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
            $exist = Merchant::where('merchant_code', $data['merchant_code'])->first();
            while ($exist) {
                $data['merchant_code'] = 'MCH' . str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
                $exist = Merchant::where('merchant_code', $data['merchant_code'])->first();
            }
            Merchant::create($data);
            LogModel::create([
                'user_id' => Auth::guard('admin')->user()->id,
                'activity' => 'Menambahkan merchant',
                'description' => 'Administrator menambahkan merchant',
            ]);
            notify()->success('Merchant berhasil ditambahkan');
            return redirect()->route('Merchant Page');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            notify()->error($th->getMessage());
            return redirect()->back();
        }
    }

    public function edit_page($id) {
        $data = Merchant::find($id);
        $users = User::all();
        LogModel::create([
            'user_id' => Auth::guard('admin')->user()->id,
            'activity' => 'Melihat halaman edit merchant',
            'description' => 'Administrator melihat halaman edit merchant',
        ]);
        return view('admin.merchant.add', compact('data', 'users'));
    }

    public function edit(Request $request, $id) {
        try {
            $request->validate([
                'user_id' => 'required',
                'name' => 'required',
                'address' => 'required',
            ]);
            $data = $request->only('user_id', 'name', 'address');
            Merchant::find($id)->update($data);
            LogModel::create([
                'user_id' => Auth::guard('admin')->user()->id,
                'activity' => 'Mengubah merchant',
                'description' => 'Administrator mengubah merchant',
            ]);
            notify()->success('Merchant berhasil diubah');
            return redirect()->route('Merchant Page');
        } catch (\Throwable $th) {
            notify()->error($th->getMessage());
            return redirect()->back();
        }
    }

    public function delete($id) {
        try {
            Merchant::find($id)->delete();
            LogModel::create([
                'user_id' => Auth::guard('admin')->user()->id,
                'activity' => 'Menghapus merchant',
                'description' => 'Administrator menghapus merchant',
            ]);
            notify()->success('Merchant berhasil dihapus');
            return redirect()->route('Merchant Page');
        } catch (\Throwable $th) {
            notify()->error($th->getMessage());
            return redirect()->back();
        }
    }
}
