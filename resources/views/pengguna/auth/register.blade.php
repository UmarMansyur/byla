@extends('pengguna.auth.index')
@section('title', 'Register Pengguna')
@section('content')
<div class="header">
  <div class="tf-container">
    <div class="tf-statusbar br-none d-flex justify-content-center align-items-center">
      <a href="#" class="back-btn"> <i class="icon-left"></i> </a>
    </div>
  </div>
</div>
<div class="mt-3 login-section">
  <div class="tf-container">
    <form class="tf-form" action="{{ route('Register Pengguna') }}" method="POST">
      @csrf
      <h1>Register</h1>
      @if (session('error'))
        <div class="alert alert-danger mb-3" style="font-size: 12px">
          {{ session('error') }}
        </div>
      @endif
      <div class="group-input">
        <label for="name">Nama Lengkap: </label>
        <input type="text" placeholder="Masukkan Nama Lengkap" id="name" name="name">
      </div>
      <div class="group-input">
        <label for="email">Email</label>
        <input type="text" placeholder="Masukkan Email" id="email" name="email">
      </div>
      <div class="group-input">
        <label for="phone">Nomor Hp.</label>
        <input type="text" id="phone" name="phone" placeholder="Masukkan Nomor Hp">
      </div>
      <div class="group-input">
        <label for="birthday">Tanggal Lahir</label>
        <input type="date" id="birthday" name="birthday">
      </div>
      <div class="group-input">
        <label for="gender">Jenis Kelamin</label>
        <select id="gender" name="gender">
          <option value="male">Laki-laki</option>
          <option value="female">Perempuan</option>
        </select>
      </div>
      <div class="group-input">
        <label for="address">Alamat</label>
        <textarea id="address" name="address" placeholder="Masukkan Alamat" rows="5"></textarea>
      </div>
      <div class="group-input">
        <label>Password</label>
        <input type="password" placeholder="Paswword terdiri dari 6-20 Karakter" id="password" name="password">
      </div>
      <div class="group-input auth-pass-input last">
        <label for="password_confirmation">Konfirmasi Password</label>
        <input type="password" class="password-input" placeholder="Masukkan Konfirmasi Password" name="password_confirmation" id="password_confirmation">
        <a class="icon-eye password-addon" id="password-addon"></a>
      </div>
      <div class="group-cb mt-5">
        <input type="checkbox" checked class="tf-checkbox">
        <label class="fw_1">Saya setuju dengan <a href="javascript:void(0)">Syarat & Ketentuan</a> </label>
      </div>
      <button type="submit" class="tf-btn accent large">Daftar</button>
    </form>
  </div>
  <div class="auth-line">Atau</div>
  <ul class="bottom socials-login mb-4">
    <li><a href="{{ route('Login Google') }}"><img src="/assets/images/icon-socials/google.png" alt="image">Lanjutkan dengan Google</a>
    </li>
  </ul>
  <p class="mb-9 fw-3 text-center ">Sudah punya akun? <a href="{{ route('Halaman Login Pengguna') }}" class="auth-link-rg">Sign In</a>
  </p>
</div>
@endsection