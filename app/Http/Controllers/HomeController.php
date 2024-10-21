<?php

namespace App\Http\Controllers;

use App\Models\Notification;
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
        if(Auth::user()) {
            $notify = Notification::where('user_id', Auth::user()->id)->where('is_read', false)->count();
            $notify_list = Notification::where('user_id', Auth::user()->id)->paginate(5);
        } else {
            $notify = 0;
            $notify_list = [];
        }
        return view('pengguna.home.index', compact('notify', 'notify_list'));
    }
}
