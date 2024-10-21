<?php

namespace App\Http\Controllers;

use App\Mail\ForgotPassword;
use App\Mail\OTP;
use App\Mail\VerifyEmail;
use App\Models\Saldo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Facades\Socialite;

class UserAuthentication extends Controller
{
    public function login_page()
    {
        return view('pengguna.auth.login');
    }

    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            $user = User::where('email', $request->email)->first();
            if (!$user) {
                return back()->with('error', 'Pengguna tidak ditemukan!');
            }

            if (!$user->is_active) {
                $payload = [
                    'email' => $user->email,
                    'expired_at' => now()->addMinutes(10),
                ];

                $token = Crypt::encryptString(json_encode($payload));
                $url = env('APP_URL') . '/verify-email?token=' . $token;
                Mail::to($user->email)->send(new VerifyEmail($user->email, $url));
                return back()->with('error', 'Akun anda belum aktif. Silahkan cek email anda untuk aktivasi akun.');
            }

            if ($user->type_login === 'google') {
                return back()->with('error', 'Akun anda login dengan Google. Silahkan login dengan Google.');
            }

            if (Auth::attempt($request->only('email', 'password'))) {
                $otp = mt_rand(100000, 999999);
                $user->update(['otp' => $otp, 'otp_expired' => now()->addMinutes(5)]);
                Mail::to($user->email)->send(new OTP($otp, $user->email));
                return redirect()->route('OTP Page');
            }

            return back()->with('error', 'Password Salah!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function otp_page()
    {
        if (!Auth::user()) {
            return redirect()->route('Halaman Login Pengguna');
        }
        return view('pengguna.auth.otp');
    }

    public function otp(Request $request)
    {
        try {
            $request->validate([
                'otp' => 'required',
            ]);

            $user = User::where('email', $request->email)->first();
            if (!$user) {
                return back()->with('error', 'Pengguna tidak ditemukan!');
            }

            if ($user->otp !== $request->otp) {
                return back()->with('error', 'OTP Salah!');
            }

            if ($user->otp_expired < now()) {
                return back()->with('error', 'OTP Kadaluarsa!');
            }

            $user->update(['otp' => null, 'otp_expired' => null]);
            return redirect()->route('home');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function register_page()
    {
        return view('pengguna.auth.register');
    }

    public function register(Request $request)
    {
        try {
            DB::beginTransaction();
            $request->validate([
                'name' => 'required',
                'password' => 'required|min:8',
                'email' => 'required|email|unique:users',
                'phone' => 'required|numeric',
                'birthday' => 'required|date',
                'gender' => 'required',
                'address' => 'required',
            ]);
            if ($request->password !== $request->password_confirmation) {
                return back()->with('error', 'Password tidak sama!');
            }
            $data = $request->only('name', 'username', 'password', 'email', 'phone', 'birthday', 'gender', 'address');
            $data['password'] = Hash::make($data['password']);
            $data['user_code'] = 'By-' . mt_rand(0000, 9999);
            $data['thumbnail'] = "https://ui-avatars.com/api/?name=" . $data['name'] . "&background=F0F0F0";
            while (User::where('user_code', $data['user_code'])->exists()) {
                $data['user_code'] = 'By-' . mt_rand(0000, 9999);
            }
            $data['is_active'] = false;
            $user = User::create($data);
            $payload = [
                'email' => $user->email,
                'expired_at' => now()->addMinutes(10),
            ];
            $token = Crypt::encryptString(json_encode($payload));
            $url = env('APP_URL') . '/verify-email?token=' . $token;
            DB::commit();
            Mail::to($user->email)->send(new VerifyEmail($user->email, $url));
            return redirect()->route('Halaman Login Pengguna')->with('success', 'Pendaftaran Berhasil!. Silahkan cek email anda untuk aktivasi akun.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    public function verify_email(Request $request)
    {
        try {
            $token = $request->query('token');

            $payload = Crypt::decryptString($token);
            $payload = json_decode($payload);
            $user = User::where('email', $payload->email)->first();
            if (!$user) {
                return redirect()->route('Halaman Login Pengguna')->with('error', 'Pengguna tidak ditemukan!');
            }

            if ($payload->expired_at < now()) {
                return redirect()->route('Halaman Login Pengguna')->with('error', 'Token Kadaluarsa!');
            }

            $user->update(['is_active' => true, 'email_verified_at' => now()]);
            return redirect()->route('Halaman Login Pengguna')->with('success', 'Verifikasi Berhasil!');
        } catch (\Throwable $th) {
            return redirect()->route('Halaman Login Pengguna')->with('error', $th->getMessage());
        }
    }

    public function login_google()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handle_google_callback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $exist = User::where('email', $user->email)->first();
            if($exist->type_login !== 'google') {
                return redirect()->route('Halaman Login Pengguna')->with('error', 'Tampaknya anda tidak bisa login dengan Google. Silahkan login dengan email dan password anda.');
            }
            if ($exist) {
                Auth::guard('web')->login($exist);
                return redirect('/');
            }
            $newUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'password' => Hash::make($user->id),
                'thumbnail' => $user->avatar,
                'is_active' => true,
                'user_code' => 'By-' . mt_rand(0000, 9999),
                'type_login' => 'google',
                'email_verified_at' => now(),
            ]);
            Auth::login($newUser);
            return redirect()->route('home');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('Halaman Login Pengguna')->with('error', $th->getMessage());
        }
    }

    public function forgot_password_page()
    {
        return view('pengguna.auth.forgot-password');
    }

    public function forgot_password(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
            ]);

            $user = User::where('email', $request->email)->first();
            if (!$user) {
                return back()->with('error', 'Pengguna tidak ditemukan!');
            }

            if ($user->type_login === 'google') {
                return back()->with('error', 'Akun anda login dengan Google. Silahkan reset password dengan menggunakan akun Google anda!.');
            }

            $payload = [
                'email' => $user->email,
                'expired_at' => now()->addMinutes(10),
            ];

            $token = Crypt::encryptString(json_encode($payload));
            $url = env('APP_URL') . '/reset-password?token=' . $token;
            Mail::to($user->email)->send(new ForgotPassword($user->email, $url));
            return back()->with('success', 'Silahkan cek email anda untuk reset password!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function reset_password_page()
    {
        return view('pengguna.auth.reset-password');
    }

    public function reset_password(Request $request)
    {
        try {
            $token = $request->token;
            $payload = Crypt::decryptString($token);
            $payload = json_decode($payload);

            if ($payload->expired_at < now()) {
                return redirect()->route('Halaman Login Pengguna')->with('error', 'Token Kadaluarsa!');
            }
            $user = User::where('email', $payload->email)->first();

            if (!$user) {
                return redirect()->route('Halaman Login Pengguna')->with('error', 'Pengguna tidak ditemukan!');
            }

            $request->validate([
                'password' => 'required|min:8',
                'password_confirmation' => 'required|same:password',
            ]);

            $user->update(['password' => Hash::make($request->password)]);
            return redirect()->route('Halaman Login Pengguna')->with('success', 'Reset Password Berhasil!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('Halaman Login Pengguna');
    }
}
