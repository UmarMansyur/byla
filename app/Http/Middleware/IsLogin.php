<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!Auth::user()) {
            return redirect()->route('Halaman Login Pengguna');
        }
        
        $existOTP = User::where('otp', '!=', null)->where('type_login', '!=', 'google')->first();
        if($existOTP) {
            return redirect()->route('Halaman Login Pengguna');
        }

        return $next($request);
    }
}
