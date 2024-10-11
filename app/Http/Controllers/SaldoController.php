<?php

namespace App\Http\Controllers;

use App\Models\LogModel;
use App\Models\Saldo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SaldoController extends Controller
{
    public function pin_page()
    {
        return view('pengguna.pin.index');
    }

    public function pin_store(Request $request)
    {
        try {
            $request->validate([
                'pin' => 'required|min:6|max:20',
                'confirm_pin' => 'required|same:pin',
            ]);

            if ($request->pin != $request->confirm_pin) {
                return redirect()->back()->with('error', 'PIN tidak sesuai');
            }
            if(Auth::user()->type_login != 'google'){
                if (!Hash::check($request->password, Auth::user()->password)) {
                    return redirect()->back()->with('error', 'Password salah!');
                }
            }

            $saldo = Saldo::where('user_id', Auth::user()->id)->first();
            if (!$saldo) {
                $saldo = Saldo::create([
                    'user_id' => Auth::user()->id,
                    'saldo' => 0,
                    'pin' => Hash::make($request->pin),
                ]);
                LogModel::create([
                    'user_id' => Auth::user()->id,
                    'log' => 'Berhasil membuat saldo dan PIN',
                ]);
            } else {
                $saldo->update([
                    'pin' => Hash::make($request->pin),
                ]);
                LogModel::create([
                    'user_id' => Auth::user()->id,
                    'log' => 'Berhasil mengubah PIN',
                ]);
            }

            return redirect()->route('home')->with('success', 'PIN berhasil dibuat');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
