@extends('admin.layouts.index')
@section('title', 'Merchant')
@section('title-bar', 'Merchant')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ isset($data) ? 'Ubah Data Merchant' : 'Tambah Data Merchant' }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ isset($data) ? route('admin.merchant.update', $data->id) : route('admin.merchants.store') }}" enctype="multipart/form-data">
                        @csrf
                        @if(isset($data))
                            @method('PUT')
                        @endif
                        <div class="form-group mb-3">
                            <label for="user_id" class="form-label">Pengguna: <span class="text-danger">*</span></label>
                            <select name="user_id" id="user_id" class="form-control" required>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id', isset($data) ? $data->user_id : '') == $data->user_id ? 'selected' : '' }}>{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Nama Merchant: <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" id="name" value="{{ old('name', isset($data) ? $data->name : '') }}" required>
                        </div>
                        <!-- Username -->
                        <div class="form-group mb-3">
                            <label for="address" class="form-label">Alamat: <span class="text-danger">*</span></label>
                            <textarea name="address" class="form-control" id="address" rows="10" required>{{ old('address', isset($data) ? $data->address : '') }}</textarea>
                        </div>
                        <!-- Is Active -->
                        <div class="form-group mb-3">
                            <label for="is_verified" class="form-label">Status: <span class="text-danger">*</span></label>
                            <select name="is_verified" id="is_verified" class="form-control" required>
                                <option value="1" {{ old('is_verified', isset($data) ? $data->is_verified : '') == 1 ? 'selected' : '' }}>Aktif</option>
                                <option value="0" {{ old('is_verified', isset($data) ? $data->is_verified : '') == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                            </select>
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="bx bx-save"></i> {{ isset($data) ? 'Ubah' : 'Tambah' }}</button>
                            <a href="{{ route('admin.users') }}" class="btn btn-secondary"><i class="bx bx-x"></i> Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            const choices = new Choices('#user_id', {
                removeItemButton: true,
                allowHTML: true
            });
        });
    </script>
@endpush
