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
    <form class="tf-form" action="{{ route('OTP') }}" method="POST">
      @csrf
      <h1>OTP Verifikasi</h1>
      @if (session('error'))
        <div class="alert alert-danger mb-3" style="font-size: 12px">
          {{ session('error') }}
        </div>
      @endif
      <div class="group-input">
        <label for="email">Email</label>
        <input type="text" placeholder="Masukkan Email" id="email" name="email" value="{{ Auth::user()->email }}" readonly>
      </div>
      <div class="group-input">
        <label for="otp">OTP: </label>
        <input type="text" placeholder="Masukkan OTP" id="otp" name="otp">
      </div>
      <button type="submit" class="tf-btn accent large">Verifikasi</button>
    </form>
  </div>
</div>
@endsection