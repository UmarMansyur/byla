<?php

namespace App\Http\Controllers;

use App\Models\Merchant;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MerchantController extends Controller
{
    public function get_data() {
        $data = Merchant::query();
        return DataTables::of($data)
        ->addColumn('user', function($data) {
            $html = '<div class="d-flex align-items-center">';
            $html.= '<img src="'.$data->user->thumbnail.'" class="rounded-circle" width="50" height="50">';
            $html.= '<div class="ms-3">';
            $html.= '<p class="fw-bold mb-0">'.$data->user->name.'</p>';
            $html.= '<p class="text-muted mb-0">'.$data->user->email.'</p>';
            $html.= '</div>';
            $html.= '</div>';
            return $html;
        })
        ->addColumn('action', function($data) {
            $button = '<a href="'.route('admin.merchant.edit', $data->id).'" class="btn btn-primary">Edit</a>';
            $button+= '<a href="'.route('admin.merchant.delete', $data->id).'" class="btn btn-danger">Delete</a>';
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
        return view('admin.merchant.index', compact('total_merchant', 'total_merchant_aktif', 'total_merchant_tidak_aktif'));
    }

    public function add_page() {
        return view('admin.merchant.add');
    }

    public function add(Request $request) {
        try {
            $request->validate([
                'user_id' => 'required',
                'name' => 'required',
                'address' => 'required',
            ]);
            $data = $request->only('user_id', 'name', 'address');
            $data['is_verified'] = true;
            $data['merchant_code'] = 'MCH' . str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
            $exist = Merchant::where('merchant_code', $data['merchant_code'])->first();
            while ($exist) {
                $data['merchant_code'] = 'MCH' . str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
                $exist = Merchant::where('merchant_code', $data['merchant_code'])->first();
            }
            Merchant::create($data);
            notify()->success('Merchant berhasil ditambahkan');
            return redirect()->route('admin.merchant.index');
        } catch (\Throwable $th) {
            notify()->error($th->getMessage());
            return redirect()->back();
        }
    }

    public function edit_page($id) {
        $data = Merchant::find($id);
        return view('admin.merchant.edit', compact('data'));
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
            notify()->success('Merchant berhasil diubah');
            return redirect()->route('admin.merchant.index');
        } catch (\Throwable $th) {
            notify()->error($th->getMessage());
            return redirect()->back();
        }
    }

    public function delete($id) {
        try {
            Merchant::find($id)->delete();
            notify()->success('Merchant berhasil dihapus');
            return redirect()->route('admin.merchant.index');
        } catch (\Throwable $th) {
            notify()->error($th->getMessage());
            return redirect()->back();
        }
    }
}
