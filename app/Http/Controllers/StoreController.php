<?php

namespace App\Http\Controllers;

use App\Models\LogModel;
use App\Models\Merchant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    public function index()
    {
        $merchant = Merchant::where('user_id', Auth::user()->id)->first();
        return view('pengguna.store.index', compact('merchant'));
    }

    public function activate_page()
    {
        return view('pengguna.store.add');
    }

    public function store(Request $request)
    {
        try {
            $exist = User::find(Auth::user()->id);
            if (!$exist) {
                return redirect()->back()->with('error', 'Anda tidak memiliki toko');
            }

            $data = $request->only('name', 'address', 'description', 'thumbnail');

            if ($request->hasFile('thumbnail')) {
                $thumbnail = $request->file('thumbnail');
                $imageName = time() . '.' . $thumbnail->getClientOriginalExtension();
                Storage::disk('public')->put('merchant/' . $imageName, file_get_contents($thumbnail));
                $data['thumbnail'] = env('APP_URL') . '/storage/merchant/' . $imageName;
            }

            $user_code = 'MCH' . str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
            while ($exist) {
                $user_code = 'MCH' . str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
                $exist = Merchant::where('merchant_code', $user_code)->first();
            }
            $data['is_verified'] = false;
            $data['merchant_code'] = $user_code;
            $data['user_id'] = Auth::user()->id;

            Merchant::create($data);
            LogModel::create([
                'user_id' => Auth::user()->id,
                'activity' => 'Mengaktifkan toko',
                'description' => 'User mengaktifkan toko',
            ]);
            notify()->success('Toko berhasil diaktifkan');
            return redirect()->route('Store Page');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->back()->with('error', 'Gagal mengaktifkan toko');
        }
    }

    public function edit_page($id)
    {
        $merchant = Merchant::find($id);
        return view('pengguna.store.add', compact('merchant'));
    }

    public function edit(Request $request, $id)
    {
        try {
            $exist = Merchant::find($id);
            if (!$exist) {
                return redirect()->back()->with('error', 'Toko tidak ditemukan');
            }
            $data = $request->only('name', 'address', 'description', 'thumbnail');

            if ($request->hasFile('thumbnail')) {
                $thumbnail = $request->file('thumbnail');
                $imageName = time() . '.' . $thumbnail->getClientOriginalExtension();
                Storage::disk('public')->put('merchant/' . $imageName, file_get_contents($thumbnail));
                $data['thumbnail'] = env('APP_URL') . '/storage/merchant/' . $imageName;

                if ($exist->thumbnail) {
                    if (Storage::disk('public')->exists('merchant/' . basename($exist->thumbnail))) {
                        Storage::disk('public')->delete('merchant/' . basename($exist->thumbnail));
                    }
                }

                $data['thumbnail'] = env('APP_URL') . '/storage/merchant/' . $imageName;
            }

            $exist->update($data);
            LogModel::create([
                'user_id' => Auth::user()->id,
                'activity' => 'Mengubah toko',
                'description' => 'User mengubah toko',
            ]);
            notify()->success('Toko berhasil diubah');
            return redirect()->route('Store Page');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Gagal mengubah toko');
        }
    }
}
