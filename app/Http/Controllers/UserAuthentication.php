<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserAuthentication extends Controller
{
    public function login_page(){
        return view('pengguna.auth.login');
    }

    public function login(Request $request) {
        try {
            $request->validate([
                'username' => 'required',
                'password' => 'required',
            ]);

            $user = User::where('username', $request->username)->first();
            if (!$user) {
                return back()->with('error', 'Pengguna tidak ditemukan!');
            }

            if(Auth::attempt($request->only('username', 'password'))){
                return redirect()->route('home');
            }

            return back()->with('error', 'Password Salah!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function register_page() {
        return view('pengguna.auth.register');
    }

    public function register(Request $request) {
        try {
            $request->validate([
                'name' => 'required',
                'username' => 'required|unique:users',
                'password' => 'required|min:8',
                'email' => 'required|email|unique:users',
                'phone' => 'required|numeric',
                'birthday' => 'required|date',
                'gender' => 'required',
                'address' => 'required',
            ]);
            $data = $request->only('name', 'username', 'password', 'email', 'phone', 'birthday', 'gender', 'address');
            $data['password'] = Hash::make($data['password']);
            $data['user_code'] = 'USR-' . mt_rand(0000, 9999);
            while(User::where('user_code', $data['user_code'])->exists()){
                $data['user_code'] = 'USR-' . mt_rand(0000, 9999);
            }
            $data['is_active'] = false;
            User::create($data);
            return redirect()->route('login')->with('success', 'Pendaftaran Berhasil!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
    public function logout() {
        Auth::logout();
        return redirect()->route('login');
    }
}
