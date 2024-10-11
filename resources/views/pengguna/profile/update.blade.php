@extends('pengguna.layouts.index')
@section('content')
@section('title-page', 'Update Profile')
@include('pengguna.layouts.back')
<div class="app-content mt-3">
  <div class="tf-container">
    <form class="tf-form" action="{{ route('Profile Update') }}" method="POST">
      @csrf
      @method('PUT')
      <div class="group-input">
        <label>Nama</label>
        <input type="text" placeholder="Masukkan nama" required name="name" id="name" value="{{ Auth::user()->name }}">
      </div>
      <div class="group-input">
        <label>Email</label>
        <input type="text" placeholder="Masukkan email" required name="email" id="email"
          value="{{ Auth::user()->email }}" {{ Auth::user()->type_login == 'google' || Auth::user()->email_verified_at ?
        'disabled' : '' }}>
      </div>
      <div class="group-input">
        <label>Nomor Hp.</label>
        <input type="text" placeholder="Masukkan nomor hp" required name="phone" id="phone"
          value="{{ Auth::user()->phone }}">
      </div>
      <div class="group-input">
        <label for="gender">Jenis Kelamin</label>
        <select name="gender" id="gender">
          <option value="">Pilih Jenis Kelamin</option>
          <option value="male" {{ Auth::user()->gender == 'male' ? 'selected' : '' }}>Laki-laki</option>
          <option value="female" {{ Auth::user()->gender == 'female' ? 'selected' : '' }}>Perempuan</option>
        </select>
      </div>
      <div class="group-input">
        <label for="birthday">Tanggal Lahir</label>
        <input type="date" name="birthday" id="birthday" value="{{ Auth::user()->birthday }}">
      </div>
      <div class="group-input">
        <label for="address">Alamat</label>
        <textarea name="address" id="address" cols="30" rows="5"
          placeholder="Masukkan alamat">{{ Auth::user()->address }}</textarea>
      </div>
      <div class="bottom-navigation-bar bottom-btn-fixed st2">
        <button type="submit" class="tf-btn accent large">Simpan</button>
      </div>
    </form>
  </div>
</div>
@endsection