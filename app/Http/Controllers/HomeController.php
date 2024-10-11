<?php

namespace App\Http\Controllers;

use App\Models\Saldo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        if(Auth::user()) {
            $saldo = Saldo::where('user_id', Auth::user()->id)->first();
            if(!$saldo) {
                return redirect()->route('pin');
            }

            if($saldo->pin == null) {
                return redirect()->route('pin');
            }
        }
        return view('pengguna.home.index');
    }
}
