@extends('pengguna.layouts.index')
@section('content')
<div class="header">
  <div class="tf-container">
    <div class="tf-statusbar d-flex align-items-center">
      <a href="{{ route('home') }}" class=""> <i class="icon-left"></i> </a>
      <h3 class="fw-bold mx-auto">Transaksi Pembelian</h3>
    </div>
  </div>
</div>
<div class="mt-5 ">
  <div class="tf-container">
    <div class="ms-auto mb-3">
      <div class="box-search my-3">
        <form action="{{ route('Transaction Page') }}" method="get">
          <div class="input-field">
            <input class="search-field value_input" placeholder="Search" type="text" value="{{ request('search') }}"
              onchange="this.form.submit()" name="search" id="">
            <span class="icon-search"></span>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="mt-5 ">
  <div class="tf-container">
    <div class="ms-auto mb-5 pb-3">
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
      <div class="infinite-scroll pb-3">
        @foreach ($products as $product)
        <div class="d-flex flex-column gap-2 border-bottom pb-2">
          <div class="d-flex align-items-center justify-content-start w-100 gap-2">
            <div class="img-product flex-shrink-0 w-50 align-self-center">
              <img src="{{ $product->thumbnail }}" alt="product" class="img-fluid" style="max-width: 200px;">
            </div>
            <div class="p-2 w-50">
              <h4 class="card-title">(#{{ $product->kode_produk }}) <br>{{ $product->title }}</h4>
              <h6 class="card-subtitle mb-2 text-muted">Rp. {{ number_format($product->sale_price, 0, ',', '.') }}
              </h6>
              <p class="card-text">
                <span class="badge bg-warning"><span id="stock-{{ $product->id }}">{{ $product->stock }}</span>
                  item</span>
              </p>
              <div class="text-end d-flex justify-content-end float-end">
                <button type="button" id="product-{{ $product->id }}"
                  class="tf-btn {{ $product->stock === 0 ? 'light' : 'accent' }} inline-block"
                  style="font-size: 14px; padding: 5px 10px; width: 4.5rem;" {{ $product->stock === 0 ? 'disabled' : ''
                  }}
                  onclick="add_to_cart({{ $product->id }})">
                  <i class="bx bx-cart"></i> Beli
                </button>
              </div>
            </div>
          </div>
          <div class="d-flex align-items-center justify-content-end w-100 px-3 d-none"
            id="cart-item-{{ $product->id }}">
            <div class="d-flex gap-2 align-items-center">
              <button type="button" class="tf-btn light align-middle px-2 py-2 rounded-circle"
                onclick="decreaseQuantity({{ $product->id }})">
                <i class="bx bx-minus"></i>
              </button>
              <input type="text" id="cart-item-quantity-{{ $product->id }}" value="0"
                class="form-control form-control-sm text-center" style="width: 100px;" oninput="splitInput(this)">
              <button type="button" class="tf-btn light align-middle px-2 py-2 rounded-circle"
                onclick="increaseQuantity({{ $product->id }})">
                <i class="bx bx-plus"></i>
              </button>
            </div>
            <div class="d-flex gap-2 align-items-center ms-2">
              <button type="button" class="tf-btn danger align-middle px-2 py-2 rounded-circle"
                onclick="hapus_produk({{ $product->id }})">
                <i class="bx bx-trash"></i>
              </button>
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
<div class="bottom-navigation-bar bg-white d-flex align-items-center justify-content-end d-none" id="button-cart-bayar">
  <div class="tf-container w-100">
    <div class="d-flex justify-content-between align-items-center gap-2">
      <a href="javascript:void(0)" class="tf-btn light mt-auto py-2" onclick="reset_cart()">
        <i class="bx bx-revision"></i> Reset
      </a>
      <a href="{{ route('Transaction Bayar Page') }}" class="tf-btn accent mt-auto py-2">
        <i class="bx bx-send"></i> Selanjutnya
      </a>
    </div>
  </div>
</div>
@endsection

@push('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jscroll/2.4.1/jquery.jscroll.min.js"></script>
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
    window.location.href = `{{ route('Delete Product', ':id') }}`.replace(':id', id);
  }
</script>
<script>
  // window on load kosongkan chart
  window.onload = function() {
    // jika session cart tidak kosong maka tampilkan button bayar
    if(sessionStorage.getItem('cart')) {
      const dataJson = sessionStorage.getItem('cart');
      document.getElementById('button-cart-bayar').classList.remove('d-none');
      const data = JSON.parse(dataJson);
      data.forEach(element => {
        document.getElementById(`cart-item-quantity-${element.product_id}`).value = element.quantity;
        document.getElementById(`stock-${element.product_id}`).innerText = check_stock(element.product_id);
        document.getElementById(`product-${element.product_id}`).classList.add('d-none');
        document.getElementById(`cart-item-${element.product_id}`).classList.remove('d-none');
        // document
      });
    }
  }


  function splitInput(input) {
    input.value = input.value.replace(/[^0-9]/g, '');
    input.value = input.value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
  }

  function add_to_cart(id) {
    increaseQuantity(id);
    if(check_stock(id) > 0) {
      document.getElementById(`cart-item-${id}`).classList.remove('d-none');
      document.getElementById(`product-${id}`).classList.add('d-none');
      document.getElementById('button-cart-bayar').classList.remove('d-none');
    }
  }
  
  function check_stock(id) {
    const stockProduct = document.getElementById(`stock-${id}`).innerText;
    return parseInt(stockProduct);
  }

  function increaseQuantity(id) {
    const quantity = document.getElementById(`cart-item-quantity-${id}`).value;
    const element = document.getElementById(`cart-item-quantity-${id}`);
    const stockProduct = document.getElementById(`stock-${id}`).innerText;
    if(parseInt(element.value) < parseInt(stockProduct)) {
      element.value = parseInt(element.value) + 1;
    } else {
      alert('Stok tidak tersedia');
      return;
    }
    const data = {
      'product_id': id,
      'quantity': element.value
    }
    const dataJson = sessionStorage.getItem('cart') ? JSON.parse(sessionStorage.getItem('cart')) : [];
    const exist = dataJson.find(item => item.product_id === id);
    if(exist) {
      exist.quantity = parseInt(element.value);
    } else {
      dataJson.push(data);
    }
    sessionStorage.setItem('cart', JSON.stringify(dataJson));
  }

  function decreaseQuantity(id) {
    const quantity = document.getElementById(`cart-item-quantity-${id}`).innerText;
    const element = document.getElementById(`cart-item-quantity-${id}`);
    if(element.value > 0) {
      element.value = parseInt(element.value) - 1;
      const dataJson = sessionStorage.getItem('cart') ? JSON.parse(sessionStorage.getItem('cart')) : [];
      const exist = dataJson.find(item => item.product_id === id);
      if(exist) {
        exist.quantity = parseInt(element.value);
      }
      const data = {
        'product_id': id,
        'quantity': element.value
      }
      sessionStorage.setItem('cart', JSON.stringify(dataJson));
    }
  }

  function reset_cart() {
    sessionStorage.removeItem('cart');
    location.reload();
  }

  function hapus_produk(id) {
    document.getElementById(`cart-item-${id}`).classList.add('d-none');
    document.getElementById(`product-${id}`).classList.remove('d-none');
    const element = document.getElementById(`cart-item-quantity-${id}`);
    element.value = 0;
    const dataJson = sessionStorage.getItem('cart') ? JSON.parse(sessionStorage.getItem('cart')) : [];
    const exist = dataJson.find(item => item.product_id === id);
    if(exist) {
      dataJson.splice(dataJson.indexOf(exist), 1);
    }
    sessionStorage.setItem('cart', JSON.stringify(dataJson));
    if(dataJson.length === 0) {
      document.getElementById('button-cart-bayar').classList.add('d-none');
    }
  }
</script>
@endpush