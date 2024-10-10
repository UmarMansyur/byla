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
        if(Auth::guard('admin')->user()) {
            return redirect()->route('admin.dashboard');
        }
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
            if (!$user) {
                notify()->error('Username tidak ditemukan!');
                return redirect()->back();
            }

            if (!Hash::check($request->password, $user->password)) {
                notify()->error('Username atau password salah!');
                return redirect()->back();
            }

            if (Auth::guard('admin')->attempt($request->only('username', 'password'))) {
                return redirect()->route('admin.dashboard');
            }

            notify()->error('Username atau password salah!');
            return redirect()->back();
        } catch (\Throwable $th) {
            dd($th);
            notify()->error($th->getMessage());
            return redirect()->back();
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
