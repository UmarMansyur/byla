@extends('pengguna.auth.index')
@section('title', 'Login Pengguna')
@section('content')
<div class="mt-7 login-section">
  <div class="tf-container">
    <form class="tf-form" action="{{ route('Login Pengguna') }}" method="POST">
      @csrf
      <h1>Login</h1>
      @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
      @endif
      @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
      @endif
      <div class="group-input mt-3">
        <label for="email">Email</label>
        <input type="text" placeholder="Masukkan Email" id="email" name="email">
      </div>
      <div class="group-input auth-pass-input last">
        <label for="password">Password</label>
        <input type="password" class="password-input" placeholder="Masukkan Password" id="password" name="password">
        <a class="icon-eye password-addon" id="password-addon"></a>
      </div>
      <a href="{{ route('Forgot Password Page') }}" class="auth-forgot-password mt-3">Forgot Password?</a>
      <button type="submit" class="tf-btn accent large">Sign In</button>
    </form>
    <div class="auth-line">Atau</div>
    <ul class="bottom socials-login mb-4">
      <li><a href="{{ route('Login Google') }}"><img src="/assets/images/icon-socials/google.png" alt="image">Lanjutkan dengan Google</a>
      </li>
    </ul>
    <p class="mb-9 fw-3 text-center ">Belum punya akun? <a href="{{ route('Halaman Register Pengguna') }}" class="auth-link-rg">Sign Up</a>
    </p>
  </div>
</div>
@endsection
