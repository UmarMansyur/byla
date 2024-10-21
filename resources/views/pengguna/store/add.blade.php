@extends('pengguna.layouts.index')
@section('content')
<div class="header">
  <div class="tf-container h-100">
    <div class="tf-statusbar d-flex align-items-center">
      <a href="{{ route('Store Page') }}" class="float-start"> <i class="icon-left"></i> </a>
      <h3 class="mx-auto">Tokoku</h3>
    </div>
  </div>
</div>
<div class="mt-5">
  <div class="tf-container">
    <form action="{{ isset($merchant) ? route('Edit Store', $merchant->id) : route('Store Activate') }}" method="post" enctype="multipart/form-data">
      @csrf
      @method(isset($merchant) ? 'PUT' : 'POST')
      <div class="tf-form">
          <div class="group-input">
              <label>Nama Toko</label>
              <input type="text" placeholder="Nama Toko" id="name" name="name" value="{{ old('name', isset($merchant) ? $merchant->name : '') }}" required>
          </div>
          <div class="group-input">
            <label for="description">Deskripsi Toko</label>
            <textarea name="description" id="description" cols="30" rows="5" placeholder="Berikan deskripsi singkat tentang toko anda untuk proses verifikasi oleh administrator">{{ old('description', isset($merchant) ? $merchant->description : '') }}</textarea>

          </div>
          <div class="group-input">
              <label>Alamat Toko</label>
            <textarea name="address" id="address" cols="30" rows="5" placeholder="Masukkan alamat lengkap toko anda">{{ old('address', isset($merchant) ? $merchant->address : '') }}</textarea>
          </div>
          <div class="group-input" id="thumbnail-group">
            <label for="thumbnail">Thumbnail Toko</label>
            <input type="file" name="thumbnail" id="thumbnail" class="form-control d-none" accept="image/*">
            <div class="mt-2">
              <div class="border border-dashed rounded p-3 d-flex justify-content-center align-items-center flex-column" id="thumbnail-preview">
                <i class="bx bx-image text-muted" style="font-size: 3rem;"></i>
                <p class="m-0 text-muted">Klik untuk menambahkan foto</p>
              </div>
            </div>
            @if(isset($merchant))
            <div class="mt-2">
              <img src="{{ $merchant->thumbnail }}" alt="thumbnail" class="img-fluid">
            </div>
            @endif
          </div>
          <div id="preview-image" class="d-none"></div>
          <div class="group-btn-change-name">
              <button type="submit" class="tf-btn accent large">Ajukan Toko</button>
              <a href="{{ route('Store Page') }}" class="tf-btn light large">Batal</a>
          </div>
      </div>
    </form>
  </div>
</div>
@endsection