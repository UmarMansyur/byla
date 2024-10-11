@extends('pengguna.layouts.index')
@section('content')
<div class="header">
  <div class="tf-container">
      <div class="tf-statusbar d-flex justify-content-center align-items-center">
          <a href="#" class="back-btn"> <i class="icon-left"></i> </a>
          <h3>PIN</h3>
      </div>
  </div>
</div>
<div class="mt-5">
  <div class="tf-container">
      <form class="tf-form" action="{{ route('Save PIN') }}" method="POST">
          @csrf
          <div class="group-input">
              <label>PIN</label>
              <input type="password" placeholder="6-20 Karakter" required min="6" max="20" inputmode="numeric" pattern="[0-9]*" autocomplete="off" name="pin" id="pin" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 20)">
              <small class="text-danger">*Karakter PIN harus berjumlah 6-20</small>
          </div>
          <div class="group-input">
              <label for="confirm_pin">Konfirmasi PIN</label>
              <input type="password" placeholder="Masukkan Konfirmasi PIN" required name="confirm_pin" id="confirm_pin" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 20)">
          </div>
          @if(Auth::user()->type_login != 'google')
          <div class="group-input last">
              <label for="password">Password</label>
              <input type="password" placeholder="Masukkan password" required name="password" id="password">
          </div>
          @endif
          @if(session('error'))
            <span class="text-danger">{{ session('error') }}</span>
          @endif
          @if(session('success'))
            <span class="text-success">{{ session('success') }}</span>
          @endif
          <div class="bottom-navigation-bar bottom-btn-fixed st2">
              <button type="submit" class="tf-btn accent large">Simpan</button>
          </div>
      </form>
  </div>
</div>
@endsection
