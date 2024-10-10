@extends('pengguna.auth.index')
@section('title', 'Forgot Password')
@section('content')
<div class="header is-fixed">
  <div class="tf-container">
    <div class="tf-statusbar br-none d-flex justify-content-center align-items-center">
      <a href="#" class="back-btn"> <i class="icon-left"></i> </a>
    </div>
  </div>
</div>
<div id="app-wrap">
  <div class="reset-pass-section mt-5">
    <div class="tf-container">
      <div class="tf-title">
        <h1>Reset Password</h1>
        <p>
          Masukkan email anda untuk menerima instruksi reset password
        </p>
      </div>
      <div class="image-box">
        <img src="/assets/images/user/forgotpass.jpg" alt="image">
      </div>
      <form action="{{ route('Forgot Password') }}" class="tf-form" method="POST">
        @csrf
        <div class="group-input">
          <label for="email">Email</label>
          <input type="text" placeholder="Masukkan Email" id="email" name="email">
        </div>
        <button type="submit" class="tf-btn accent large">Next</button>
      </form>
    </div>
  </div>
</div>