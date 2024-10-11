<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
