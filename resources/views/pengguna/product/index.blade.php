@extends('pengguna.layouts.index')
@section('content')
<div class="header">
  <div class="tf-container">
    <div class="tf-statusbar d-flex align-items-center">
      <a href="{{ route('home') }}" class=""> <i class="icon-left"></i> </a>
      <h3 class="fw-bold mx-auto">Produk</h3>
    </div>
  </div>
</div>
<div class="app-header"></div>
<div class="card-secton">
  <div class="tf-container">
    <div class="tf-balance-box">
      <div class="balance">
        <div class="row">
          <div class="col-6 br-right">
            <div class="inner-left">
              <p>Total Produk:</p>
              <h3>{{ $total_product }}</h3>
            </div>
          </div>
          <div class="col-6">
            <div class="inner-right">
              <p>Asset Produk</p>
              <h3>Rp. {{ number_format($total_asset, 0, ',', '.') }}</h3>
            </div>
          </div>
        </div>
      </div>
      <div class="text-center mt-2">
        Silahkan scroll ke bawah untuk melihat produk anda
      </div>
    </div>
  </div>

</div>
<div class="mt-5">
  <div class="tf-container">
    <div class="d-flex justify-content-end mb-3">
      <a href="{{ route('Add Product Page') }}" class="tf-btn accent py-2">
        <i class="bx bx-plus"></i> Tambah Product
      </a>
    </div>
    <div class="ms-auto mb-3">
      <div class="box-search my-3">
        <form action="{{ route('Product Page') }}" method="get">
          <div class="input-field">
            <span class="icon-search"></span>
            <input class="search-field value_input" placeholder="Search" type="text" value="{{ request('search') }}"
              onchange="this.form.submit()" name="search">
            <span class="icon-clear"></span>
          </div>
        </form>
      </div>
      <div class="modal fade" id="modal-hapus" aria-modal="true" role="dialog" style="font-size: 14px;">
        <div class="modal-dialog modal-dialog-centered p-4" role="document">
          <div class="modal-content p-4">
            <div class="heading">
              <h4 class="fw_6 text-center">
                Hapus Produk
              </h4>
              <p class="fw_4 mt-2 text-center">Apakah anda yakin ingin menghapus produk ini?</p>
            </div>
            <div class="bottom d-flex justify-content-center mt-3">
              <a href="javascript:void(0)" class="secondary_color btn-hide-modal w-100 text-center border"
                data-bs-dismiss="modal" aria-label="Close" style="font-size: 15px; padding: 10px 20px;">Tidak</a>
              <a href="javascript:void(0)" class="primary_color btn-hide-modal w-100 text-center border"
                data-bs-dismiss="modal" aria-label="Close" style="font-size: 15px; padding: 10px 20px;" id="btn-hapus"
                onclick="hapus_produk()">Ya</a>
            </div>
          </div>
        </div>
      </div>
      <div class="infinite-scroll">
        @foreach ($products as $product)
        <div class="card mb-2" style="border-radius: 0.50rem;">
          <div class="card-body d-flex flex-column gap-3 p-0">
            <div class="d-flex">
              <div class="d-flex align-items-center justify-content-between w-100 gap-2">
                <div class="img-product">
                  <img src="{{ $product->thumbnail }}" alt="product" class="img-fluid"
                    style="max-width: 80px; height: fit-content;">
                </div>
                <div>
                  <h5 class="card-title">(#{{ $product->kode_produk }}) {{ Str::limit($product->title, 20) }}</h5>
                  <h6 class="card-subtitle mb-2 text-muted">Rp. {{ number_format($product->sale_price, 0, ',', '.') }}
                  </h6>
                  <p class="card-text">
                    <span class="badge bg-warning">{{ $product->stock }} item</span>
                  </p>
                </div>
                <div class="ms-auto d-flex gap-2 pe-3">
                  <a href="{{ route('Edit Product Page', $product->id) }}" class="btn btn-sm">
                    <i class="bx bx-pencil"></i>
                  </a>
                  <a href="#modal-hapus" class="btn btn-sm" data-bs-toggle="modal" data-product-id="{{ $product->id }}">
                    <i class="bx bx-trash"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endforeach
        <div class="text-center d-none">
          {{ $products->links() }}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@push('script')
<script type="text/javascript">
  $(document).ready(function() {
      $('.infinite-scroll').jscroll({
        autoTrigger: true,
        loadingHtml: '<div class="text-center flex-column"><i class="bx bx-loader bx-spin font-weight-bold"></i><p>Memuat data...</p></div>',
        padding: 0,
        nextSelector: 'a[rel="next"]',
        contentSelector: 'div.infinite-scroll',
        callback: function() {
          $('nav.pagination').hide();
        }
      });
    });
</script>
<script>
  function hapus_produk() {
    const id = document.querySelector('[data-product-id]').getAttribute('data-product-id');
    window.location.href = `{{ route('Delete Product', '') }}/${id}`;
  }
</script>
@endpush