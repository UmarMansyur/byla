@extends('pengguna.layouts.index')
@section('content')
<div class="header">
  <div class="tf-container">
    <div class="tf-statusbar d-flex align-items-center">
      <a href="{{ route('History Page') }}" class="float-start"> <i class="icon-left"></i> </a>
      <h3 class="mx-auto">Riwayat Transaksi</h3>
    </div>
  </div>
</div>
<div class="tf-container mt-0">
  <div class="wrapper-bill">
    <div class="archive-top">
      <span class="circle-box lg bg-primary">
        <svg width="63" height="62" viewBox="0 0 63 62" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path
            d="M31.5 11.2783L27.023 7.68753L22.5459 11.2824L18.069 7.68753V50.3189L22.5459 53.9139L27.023 50.3189L31.5 53.9139L31.6334 53.5819L32.3766 30.9701L31.6419 11.3564L31.5 11.2783Z"
            fill="white"></path>
          <path
            d="M40.454 11.2824L35.977 7.68753L31.5 11.2783V53.9139L35.977 50.3189L40.454 53.9139L44.931 50.3189V7.68753L40.454 11.2824Z"
            fill="white"></path>
          <path d="M21.681 17.808V21.364H31.642L31.9964 19.5859L31.642 17.808H21.681Z" fill="#C5C5C5"></path>
          <path d="M31.5051 17.808H35.6749V21.364H31.5051V17.808Z" fill="#C5C5C5"></path>
          <path d="M21.681 31.2109H29.7102V34.7669H21.681V31.2109Z" fill="#C5C5C5"></path>
          <path d="M21.681 38.3227H29.7102V41.8786H21.681V38.3227Z" fill="#4A84F6"></path>
          <path d="M21.6597 24.3728V27.9286H31.6419L31.9964 26.0385L31.6419 24.3728H21.6597Z" fill="#C5C5C5"></path>
          <path d="M31.5051 24.3728H41.3404V27.9287H31.5051V24.3728Z" fill="#C5C5C5"></path>
          <path
            d="M37.7163 40.5659C36.3815 40.4515 35.4027 39.943 34.7035 39.2438L35.6951 37.8327C36.1655 38.3285 36.8647 38.7734 37.7164 38.926V36.9555C36.407 36.6376 34.9832 36.1419 34.9832 34.413C34.9832 33.1291 36.0002 32.0358 37.7164 31.8578V30.6756H38.9114V31.8833C39.941 31.9977 40.8182 32.379 41.5047 33.0146L40.5005 34.3622C40.0429 33.9427 39.4835 33.6757 38.9114 33.5358V35.2901C40.2335 35.6206 41.7082 36.1292 41.7082 37.8707C41.7082 39.2819 40.7801 40.3751 38.9114 40.5658V41.7099H37.7164V40.5659H37.7163ZM37.7163 34.9979V33.4597C37.157 33.536 36.8391 33.841 36.8391 34.2733C36.8392 34.6419 37.1951 34.8326 37.7163 34.9979ZM38.9114 37.248V38.9514C39.5597 38.8242 39.8648 38.4556 39.8648 38.0488C39.8648 37.6294 39.4707 37.426 38.9114 37.248Z"
            fill="#F2C71C"></path>
        </svg>
      </span>
      <h1><a href="#" class="text-muted">Rp. {{ number_format($transaction->nominal, 0, ',', '.') }}</a></h1>
      <h3 class="mt-2 fw_6">Detail Transaksi</h3>
      <small class="text-muted">{{ $transaction->kode_transaksi }}</small>
      <p class="fw_4 mt-2 text-uppercase">
        {{ $transaction->status }}
      </p>
    </div>
    <div class="dashed-line"></div>
    <div class="archive-bottom">
      @if($transaction->user_id == Auth::user()->id && $transaction->status == 'pending')
      <h2 class="text-center">Scan QR</h2>
      <div class="text-center mb-4">
        {!! $qrCode !!}
      </div>
      @endif
      <h2 class="text-center">Informasi Merchant</h2>
      <ul>
        <li class="list-info-bill">Kode Merchant <span>{{ $transaction->merchant->merchant_code }}</span> </li>
        <li class="list-info-bill">Nama Merchant <span>{{ $transaction->merchant->name }}</span> </li>
        <li class="list-info-bill">Alamat <span class="text-end">{{ $transaction->merchant->address }}</span> </li>
        <hr>
        <li class="list-info-bill fw-bold text-dark d-flex justify-content-center">
          <h2 class="text-center">Detail Pembelian</h2>
        </li>
        @foreach ($transaction_detail as $detail)
        <li class="list-info-bill row align-items-center">
          <div class="col text-dark">
            {{ $detail->product ? $detail->product->title : '' }}
          </div>
          <div class="col text-center text-dark">
            {{ $detail->quantity }} x
          </div>
          <div class="col text-end text-dark">
            Rp. {{ number_format($detail->product->sale_price, 0, ',', '.') }}
          </div>
        </li>
        @endforeach
        <li class="list-info-bill">
          <h4>Total</h4>
          <h4>Rp. {{ number_format($transaction->nominal, 0, ',', '.') }}</h4>
        </li>
      </ul>
      <hr>
      @if ($transaction->status == 'success')
      <h2 class="text-center mt-3">Informasi Pembeli</h2>
      <div class="row mb-3">
        <div class="col">
          <h5>Nama</h5>
        </div>
        <div class="col text-end">
          <h5><span>{{ $buyer->name }}</span> </h5>
        </div>
      </div>
      <div class="row mb-3">
        <div class="col">
          <h5>Email</h5>
        </div>
        <div class="col text-end">
          <h5><span>{{ $buyer->email }}</span> </h5>
        </div>
      </div>
      <div class="row mb-3">
        <div class="col">
          <h5>Nomer HP</h5>
        </div>
        <div class="col text-end">
          <h5><span>{{ $buyer->phone ? $buyer->phone : '-' }}</span> </h5>
        </div>
      </div>
      @endif
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
  window.onload = function() {
  Pusher.logToConsole = true;

  const pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
    cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
  });

  const channel = pusher.subscribe('transaction');
  channel.bind('transaction-update', function(data) {
    if(data === 'success') {
      window.location.href = `/transaction/success?kode_transaksi={{ $transaction->kode_transaksi }}`;
    }
  });
}
</script>
@endpush