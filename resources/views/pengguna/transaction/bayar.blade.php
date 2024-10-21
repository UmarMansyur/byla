@extends('pengguna.layouts.index')
@section('content')
<div class="header">
  <div class="tf-container">
    <div class="tf-statusbar d-flex align-items-center">
      <a href="{{ route('home') }}" class=""> <i class="icon-left"></i> </a>
      <h3 class="fw-bold mx-auto">Keranjang Pembelian</h3>
    </div>
  </div>
</div>
<div class="mt-5 ">
  <div class="tf-container">
    <div class="ms-auto mb-3">
      <div class="box-search my-3">
        <form action="{{ route('Product Page') }}" method="get">
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
    <div class="ms-auto mb-3 pb-5">
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
      <div class="infinite-scroll pb-5 mb-5" id="cart-item"></div>
    </div>
  </div>
</div>
<div class="bottom-navigation-bar bg-white d-flex align-items-center justify-content-end" id="button-cart-bayar">
  <div class="tf-container w-100">
    <div class="d-flex justify-content-between align-items-center my-3">
      <h2>Total Bayar</h2>
      <h4 id="total-bayar">Rp. 0</h4>
    </div>
    <div class="d-flex justify-content-between align-items-center gap-2 mb-3">
      <button type="button" class="tf-btn accent mt-auto py-2" onclick="bayar()">
        <i class="bx bx-wallet-alt"></i> Bayar
      </button>
    </div>
  </div>
</div>
@endsection

@push('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jscroll/2.4.1/jquery.jscroll.min.js"></script>
<script>
  const element = document.getElementById('cart-item');
async function main() {
  const cart = sessionStorage.getItem('cart') ? JSON.parse(sessionStorage.getItem('cart')) : [];
  if (cart.length === 0) {
    console.warn('Cart is empty');
    return;
  }

  const response = await fetch(`/transaction/cart`, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({
      product_id: cart.map(item => item.product_id)
    })
  });

  const data = await response.json();
  const result = data.map((item) => {
    return {
      ...item,
      quantity: cart.find(cartItem => cartItem.product_id === item.id)?.quantity || 0
    }
  });
  const total = result.reduce((acc, item) => acc + (item.sale_price * item.quantity), 0);
  const elementTotal = document.getElementById('total-bayar');
  elementTotal.innerText = `Rp. ${new Intl.NumberFormat('id-ID').format(total)}`;
  const htmlData = result.map((item, a) => {

    return `
      <div class="d-flex flex-column gap-2 border-bottom pb-2" id="cart-position-${item.id}">
          <div class="d-flex align-items-center justify-content-start w-100 gap-2">
            <div class="img-product flex-shrink-0 w-50 align-self-center">
              <img src="${item.thumbnail}" alt="product" class="img-fluid" style="max-width: 200px;">
            </div>
            <div class="p-2 w-50">
              <h4 class="card-title">(#${item.kode_produk}) <br>${item.title}</h4>
              <h6 class="card-subtitle mb-2 text-muted" id="price-${item.id}">Rp. ${new Intl.NumberFormat('id-ID').format(item.sale_price)}
              </h6>
              <p class="card-text">
                <span class="badge bg-warning"><span id="stock-${item.id}">${item.stock}</span>
                  item</span>
              </p>
            </div>
          </div>
          <div class="d-flex align-items-center justify-content-end w-100 px-3"
            id="cart-item-${item.id}">
            <div class="d-flex gap-2 align-items-center">
              <button type="button" class="tf-btn accent align-middle rounded-circle px-2 py-2"
                onclick="decreaseQuantity(${item.id})">
                <i class="bx bx-minus"></i>
              </button>
              <input type="hidden" id="cart-item-quantity-${item.id}-total" value="${item.quantity}">
              <input type="text" id="cart-item-quantity-${item.id}" value="${item.quantity}"
                class="form-control form-control-sm text-center" style="width: 100px;" oninput="splitInput(this)" readonly>
              <button type="button" class="tf-btn accent align-middle rounded-circle px-2 py-2"
                onclick="increaseQuantity(${item.id})">
                <i class="bx bx-plus"></i>
              </button>
            </div>
            <div class="d-flex gap-2 align-items-center ms-2">
              <button type="button" class="tf-btn danger align-middle rounded-circle px-2 py-2"
                onclick="hapus_produk(${item.id})">
                <i class="bx bx-trash"></i>
              </button>
            </div>
          </div>
        </div>
    `;
  }).join('');
  element.innerHTML = htmlData;
}

window.onload = async () => {
  await main();
};

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

  async function increaseQuantity(id) {
    const element = document.getElementById(`cart-item-quantity-${id}`);
    const itemElement = document.getElementById(`cart-item-quantity-${id}-total`);
    const stockProduct = document.getElementById(`stock-${id}`).innerText;
    if(parseInt(element.value) < parseInt(stockProduct)) {
      element.value = parseInt(element.value) + 1;
      itemElement.value = element.value;
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
    const priceProduct = document.getElementById(`price-${id}`).innerText;
    const priceProductInt = parseInt(priceProduct.replace(/[^0-9]/g, ''));
    const total = document.getElementById('total-bayar').innerText;
    const totalPrice = parseInt(total.replace(/[^0-9]/g, '')) + (priceProductInt);
    document.getElementById('total-bayar').innerText = `Rp. ${new Intl.NumberFormat('id-ID').format(totalPrice)}`;
  }

  function decreaseQuantity(id) {
    const element = document.getElementById(`cart-item-quantity-${id}`);
    const itemElement = document.getElementById(`cart-item-quantity-${id}-total`);

    const stockProduct = document.getElementById(`stock-${id}`).innerText;
    if(element.value > 0) {
      element.value = parseInt(element.value) - 1;
      const dataJson = sessionStorage.getItem('cart') ? JSON.parse(sessionStorage.getItem('cart')) : [];
      const exist = dataJson.find(item => item.product_id === id);
      if(exist) {
        exist.quantity = parseInt(element.value);
        itemElement.value = exist.quantity;
      }
      const data = {
        'product_id': id,
        'quantity': element.value
      }
      sessionStorage.setItem('cart', JSON.stringify(dataJson));
      // ambil total harga sekarang dan jumlahkan dengan harga produk
      const total = document.getElementById('total-bayar').innerText;
      const priceProduct = document.getElementById(`price-${id}`).innerText;
      const priceProductInt = parseInt(priceProduct.replace(/[^0-9]/g, ''));
      const totalPrice = parseInt(total.replace(/[^0-9]/g, '')) - priceProductInt;
      document.getElementById('total-bayar').innerText = `Rp. ${new Intl.NumberFormat('id-ID').format(totalPrice)}`;
    }
  }

  function reset_cart() {
    sessionStorage.removeItem('cart');
    location.reload();
  }

  function hapus_produk(id) {
    if(confirm('Apakah anda yakin ingin menghapus produk ini?')) {
      const element = document.getElementById(`cart-item-quantity-${id}`);
      const position = document.getElementById(`cart-position-${id}`);
      element.value = 0;
      const dataJson = sessionStorage.getItem('cart') ? JSON.parse(sessionStorage.getItem('cart')) : [];
      const exist = dataJson.find(item => item.product_id === id);
      if(exist) {
      dataJson.splice(dataJson.indexOf(exist), 1);
      position.remove();
    }
    sessionStorage.setItem('cart', JSON.stringify(dataJson));
    if(dataJson.length === 0) {
      document.getElementById('button-cart-bayar').classList.add('d-none');
    }
  }
}

async function bayar() {
  const total = document.getElementById('total-bayar').innerText;
  const totalPrice = parseInt(total.replace(/[^0-9]/g, ''));
  const dataJson = sessionStorage.getItem('cart') ? JSON.parse(sessionStorage.getItem('cart')) : [];

  if (dataJson.length === 0) {
    return;
  }

  const data = {
    total_price: totalPrice,
    cart: dataJson
  };

  console.log(data);

  $.ajax({
    url: '/transaction/payment',
    method: 'POST',
    data: {
      _token: '{{ csrf_token() }}',
      total_price: data.total_price,
      cart: data.cart
    },
    success: function(response) {
      sessionStorage.removeItem('cart');
      sessionStorage.setItem('transaction', JSON.stringify(response));
      window.location.href = '/transaction/final';
    }
  });
}



</script>
@endpush