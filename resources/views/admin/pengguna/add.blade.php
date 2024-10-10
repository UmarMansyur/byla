@extends('admin.layouts.index')
@section('title', 'Pengguna')
@section('title-bar', 'Pengguna')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ isset($user) ? 'Ubah Data Pengguna' : 'Tambah Data Pengguna' }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ isset($user) ? route('admin.users.update', $user->id) : route('admin.users.store') }}" enctype="multipart/form-data">
                        @csrf
                        @if(isset($user))
                            @method('PUT')
                        @endif
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Nama Lengkap: <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" id="name" value="{{ old('name', isset($user) ? $user->name : '') }}" required>
                        </div>
                        @if(!isset($user))
                        <div class="form-group mb-3">
                            <label for="password" class="form-label">Password: <span class="text-danger">*</span></label>
                            <input type="password" name="password" class="form-control" id="password" {{ isset($user) ? '' : 'required' }}>
                            @if(isset($user))
                                <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah password.</small>
                            @endif
                        </div>
                        @endif

                        <!-- Email -->
                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Email: <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control" id="email" value="{{ old('email', isset($user) ? $user->email : '') }}" required>
                        </div>

                        <!-- Phone -->
                        <div class="form-group mb-3">
                            <label for="phone" class="form-label">No. HP: <span class="text-danger">*</span></label>
                            <input type="text" name="phone" class="form-control" id="phone" value="{{ old('phone', isset($user) ? $user->phone : '') }}" required>
                        </div>

                        <!-- Thumbnail -->
                        <div class="form-group mb-3">
                            <label for="thumbnail" class="form-label">Thumbnail</label>
                            <input type="file" name="thumbnail" class="form-control" id="thumbnail">
                            @if(isset($user) && $user->thumbnail)
                                <img src="{{ $user->thumbnail }}" alt="Thumbnail" class="img-thumbnail mt-2" width="150">
                            @endif
                        </div>

                        <!-- Birthday -->
                        <div class="form-group mb-3">
                            <label for="birthday" class="form-label">Tanggal Lahir: <span class="text-danger">*</span></label>
                            <input type="date" name="birthday" class="form-control" id="birthday" value="{{ old('birthday', isset($user) ? $user->birthday : '') }}" required>
                        </div>

                        <!-- Gender -->
                        <div class="form-group mb-3">
                            <label for="gender" class="form-label">Jenis Kelamin: <span class="text-danger">*</span></label>
                            <select name="gender" id="gender" class="form-control" required>
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="male" {{ old('gender', isset($user) ? $user->gender : '') == 'male' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="female" {{ old('gender', isset($user) ? $user->gender : '') == 'female' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>

                        <!-- Address -->
                        <div class="form-group mb-3">
                            <label for="address" class="form-label">Alamat: <span class="text-danger">*</span></label>
                            <textarea name="address" class="form-control" id="address" rows="3" required>{{ old('address', isset($user) ? $user->address : '') }}</textarea>
                        </div>

                        <!-- Is Active -->
                        <div class="form-group mb-3">
                            <label for="is_active" class="form-label">Status: <span class="text-danger">*</span></label>
                            <select name="is_active" id="is_active" class="form-control" required>
                                <option value="1" {{ old('is_active', isset($user) ? $user->is_active : '') == 1 ? 'selected' : '' }}>Aktif</option>
                                <option value="0" {{ old('is_active', isset($user) ? $user->is_active : '') == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                            </select>
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="bx bx-save"></i> {{ isset($user) ? 'Ubah' : 'Tambah' }}</button>
                            <a href="{{ route('admin.users') }}" class="btn btn-secondary"><i class="bx bx-x"></i> Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
