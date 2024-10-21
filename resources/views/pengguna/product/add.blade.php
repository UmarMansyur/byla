@extends('pengguna.layouts.index')

@section('content')
<div class="header">
  <div class="tf-container h-100">
    <div class="tf-statusbar d-flex align-items-center">
      <a href="{{ route('Product Page') }}" class="float-start"> <i class="icon-left"></i> </a>
      <h3 class="mx-auto">Produk</h3>
    </div>
  </div>
</div>
<div class="mt-5">
  <div class="tf-container">
    <form action="{{ isset($produk) ? route('Edit Product', $produk->id) : route('Add Product') }}" method="post" enctype="multipart/form-data">
      @csrf
      @method(isset($produk) ? 'PUT' : 'POST')
      <div class="tf-form">
          <div class="group-input">
              <label>Kode Produk</label>
              <input type="text" placeholder="Kode Produk" id="kode_produk" name="kode_produk" value="{{ old('kode_produk', isset($produk) ? $produk->kode_produk : '') }}" required>
          </div>
          <div class="group-input">
              <label>Nama Produk</label>
              <input type="text" placeholder="Nama Produk" id="title" name="title" value="{{ old('title', isset($produk) ? $produk->title : '') }}" required>
          </div>
          <div class="group-input">
              <label for="price">Harga Beli(Modal)</label>
              <input type="text" placeholder="Harga Produk" id="price" name="price" value="{{ old('price', isset($produk) ? number_format($produk->price, 0, ',', '.') : '') }}" required oninput="formatPrice(this)">
          </div>
          <div class="group-input">
              <label for="sale_price">Harga Jual</label>
              <input type="text" placeholder="Harga Diskon" id="sale_price" name="sale_price" value="{{ old('sale_price', isset($produk) ? number_format($produk->sale_price, 0, ',', '.') : '') }}" oninput="formatPrice(this)">
          </div>
          <div class="group-input">
              <label for="stock">Stok</label>
              <input type="text" placeholder="Stok" id="stock" name="stock" value="{{ old('stock', isset($produk) ? $produk->stock : '') }}" oninput="formatPrice(this)">
          </div>
          <div class="group-input">
            <label for="description">Deskripsi Produk</label>
            <textarea name="description" id="description" cols="30" rows="5" placeholder="Berikan deskripsi singkat tentang produk anda">{{ old('description', isset($produk) ? $produk->description : '') }}</textarea>
          </div>
          <div class="group-input" id="thumbnail-group">
            <label for="thumbnail">Thumbnail Produk</label>
            <input type="file" name="thumbnail" id="thumbnail" class="form-control d-none" accept="image/*">
            <div class="mt-2">
              <div class="border border-dashed rounded p-3 d-flex justify-content-center align-items-center flex-column" id="thumbnail-preview">
                <i class="bx bx-image text-muted" style="font-size: 3rem;"></i>
                <p class="m-0 text-muted">Klik untuk menambahkan foto</p>
              </div>
            </div>
            @if(isset($produk))
            <div class="mt-2">
              <img src="{{ $produk->thumbnail }}" alt="thumbnail" class="img-fluid rounded" id="preview-image-thumbnail">
            </div>
            @endif
          </div>
          <div id="preview-image" class="d-none"></div>
          @if(session('success'))
          <div class="alert alert-success">
            {{ session('success') }}
          </div>
          @endif
          @if(session('error'))
          <div class="alert alert-danger">
            {{ session('error') }}
          </div>
          @endif
          <div class="group-btn-change-name">
              <button type="submit" class="tf-btn accent large">{{ isset($produk) ? 'Edit' : 'Tambah' }}</button>
              <a href="{{ route('Product Page') }}" class="tf-btn light large">Batal</a>
          </div>
      </div>
    </form>
  </div>
</div>

<script>
function formatPrice(input) {
  let value = input.value.replace(/\D/g, '');
  input.value = new Intl.NumberFormat('id-ID').format(value);
}
</script>
@endsection
