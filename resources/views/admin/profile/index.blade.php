@extends('admin.layouts.index')
@section('title-bar', 'Profil')
@section('title', 'Profil')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h5 class="card-title">Profil Admin</h5>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-4">
            <img src="{{ Str::startsWith($admin->thumbnail, 'https://') ? $admin->thumbnail : asset('storage/' . $admin->thumbnail) }}" alt="Foto Profil" class="img-fluid rounded-circle mb-3">
          </div>
          <div class="col-md-8">
            <h4>{{ $admin->name }}</h4>
            <p><strong>Username:</strong> {{ $admin->username }}</p>
            <p><strong>Email:</strong> {{ $admin->email }}</p>
            <p><strong>Nomor Telepon:</strong> {{ $admin->phone }}</p>
            <p><strong>Tanggal Lahir:</strong> {{ $admin->birthday }}</p>
            <p><strong>Jenis Kelamin:</strong> {{ $admin->gender }}</p>
            <p><strong>Alamat:</strong> {{ $admin->address }}</p>
          </div>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header">
        <h5 class="card-title">Ubah Profil</h5>
      </div>
      <div class="card-body">
        <form action="{{ route('admin.profile.update') }}" method="post" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="form-group mb-2">
            <label for="name">Nama</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $admin->name }}">
          </div>
          <div class="form-group mb-2">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $admin->email }}">
          </div>
          <div class="form-group mb-2">
            <label for="phone">Nomor Telepon</label>
            <input type="text" name="phone" id="phone" class="form-control" value="{{ $admin->phone }}">
          </div>
          <div class="form-group mb-2">
            <label for="address">Alamat</label>
            <input type="text" name="address" id="address" class="form-control" value="{{ $admin->address }}">
          </div>
          <div class="form-group mb-2">
            <label for="thumbnail">Foto Profil</label>
            <input type="file" name="thumbnail" id="thumbnail" class="form-control">
          </div>
          <div class="my-3">
            <button type="submit" class="btn btn-primary">
              <i class="bx bx-save"></i> Simpan
            </button>
            <a href="{{ route('admin.profile') }}" class="btn btn-secondary">
              <i class="bx bx-x"></i> Batal
            </a>
          </div>
        </form>
      </div>
    </div>
    <div class="card">
      <div class="card-header">
        <h5 class="card-title">Ubah Password</h5>
      </div>
      <div class="card-body">
        <form action="{{ route('admin.profile.update-password') }}" method="post">
          @csrf
          @method('PUT')

          <div class="form-group mb-2">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control">
          </div>
          {{-- konfirmasi password --}}
          <div class="form-group mb-2">
            <label for="password_confirmation">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
          </div>
          <div class="my-3">
            <button type="submit" class="btn btn-primary">
              <i class="bx bx-save"></i> Simpan
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
