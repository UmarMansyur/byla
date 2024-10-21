<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Container\Attributes\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage as FacadesStorage;

class ProfileController extends Controller
{
    public function index() {
        return view('pengguna.profile.index', [
            'title_page' => 'Profile'
        ]);
    }

    public function detail() {
        return view('pengguna.profile.detail', [
            'title_page' => 'Profile Detail'
        ]);
    }


    public function update_page() {
        return view('pengguna.profile.update', [
            'title_page' => 'Update Profile'
        ]);
    }
    
    public function update_profile(Request $request) {
      try {
        
        $exist_phone = User::where('phone', $request->phone)->whereNot('id', Auth::user()->id)->first();
        if ($exist_phone) {
            return redirect()->route('Profile Update Page')->with('error', 'Nomor handphone sudah terdaftar');
        }
        $data = $request->only(['name', 'phone', 'email', 'address', 'gender', 'birthday']);
        User::where('id', Auth::user()->id)->update($data);
        return redirect()->route('Profile Page')->with('success', 'Profile updated successfully');
      } catch (\Throwable $th) {
        dd($th);
        return redirect()->route('Profile Page')->with('error', 'Failed to update profile');
      }  
    }

    public function admin_index() {
        $admin = Auth::guard('admin')->user();
        return view('admin.profile.index', [
            'title_page' => 'Profile',
            'admin' => $admin
        ]);
    }

    public function admin_update_profile(Request $request) {
        try {
            $data = $request->only(['name', 'phone', 'email', 'address', 'thumbnail']);
            if ($request->hasFile('thumbnail')) {
                $imageName = time() . '.' . $request->thumbnail->extension();
                FacadesStorage::putFileAs('public/admin/thumbnail', $request->thumbnail, $imageName);
                $data['thumbnail'] = $imageName;
            }
            Admin::where('id', Auth::guard('admin')->user()->id)->update($data);
            return redirect()->route('admin.profile')->with('success', 'Profile updated successfully');
        } catch (\Throwable $th) {
            dd($th);
            return redirect()->route('admin.profile')->with('error', 'Failed to update profile');
        }
    }

    public function admin_update_password(Request $request) {
        try {
            $data = $request->only(['password', 'password_confirmation']);
            if ($data['password'] !== $data['password_confirmation']) {
                return redirect()->route('admin.profile')->with('error', 'Password tidak cocok');
            }
            Admin::where('id', Auth::guard('admin')->user()->id)->update(['password' => Hash::make($data['password'])]);
            return redirect()->route('admin.profile')->with('success', 'Password updated successfully');
        } catch (\Throwable $th) {
            dd($th);
            return redirect()->route('admin.profile')->with('error', 'Failed to update password');
        }
    }
}
