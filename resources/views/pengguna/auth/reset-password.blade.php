@extends('pengguna.auth.index')
@section('title', 'Reset Password')
@section('content')
<div class="header">
  <div class="tf-container">
    <div class="tf-statusbar br-none d-flex justify-content-center align-items-center">
      <a href="#" class="back-btn"> <i class="icon-left"></i> </a>
    </div>
  </div>
</div>
<div class="mt-5 newpass-section">
  <div class="tf-container">
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
    <form class="tf-form" action="{{ route('Reset Password') }}" method="POST">
      @csrf
      <input type="hidden" name="token" value="{{ request()->token }}">
      <h1>Buat Password Baru</h1>
      <div class="group-input">
        <label>Password</label>
        <input type="password" placeholder="Masukkan Password Baru" id="password" name="password">
      </div>
      <div class="group-input last">
        <label>Konfirmasi Password</label>
        <input type="password" placeholder="Masukkan Konfirmasi Password Baru" id="password_confirmation" name="password_confirmation">
      </div>
      <button type="submit" class="tf-btn accent large">Reset Password</button>
    </form>
  </div>
</div>
@endsection