<?php

namespace App\Http\Controllers;

use App\Models\LogModel;
use App\Models\Saldo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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
                    'activity' => 'create',
                    'description' => 'Berhasil membuat saldo dan PIN',
                ]);
            } else {
                $saldo->update([
                    'pin' => Hash::make($request->pin),
                ]);

                LogModel::create([
                    'user_id' => Auth::user()->id,
                    'activity' => 'update',
                    'description' => 'Berhasil mengubah PIN',
                ]);
            }

            return redirect()->route('home')->with('success', 'PIN berhasil dibuat');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function my_qrCode() {
        $qrcode = QrCode::size(350)->generate(Auth::user()->user_code);
        return view('pengguna.profile.qrcode', compact('qrcode'));
    }

    public function scan_qr_page() {
        return view('pengguna.profile.scanqr');
    }
}
