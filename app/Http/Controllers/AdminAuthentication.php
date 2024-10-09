<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminAuthentication extends Controller
{
    public function login_page()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        try {
            $request->validate([
                'username' => 'required',
                'password' => 'required',
            ]);
            $user = Admin::where('username', $request->username)->first();
            if(!$user) {
                notify()->error('Username tidak ditemukan!');
                return redirect()->back();
            }
            if(!Hash::check($request->password, $user->password)) {
                notify()->error('Username atau password salah!');
                return redirect()->back();
            }
            // simpan data user ke session auth
            Auth::login($user);
            return redirect()->route('admin.dashboard');
        } catch (\Throwable $th) {
            dd($th);
            notify()->error($th->getMessage());
            return redirect()->back();
        }
    }
}
