@section('content')
@extends('pengguna.layouts.index')
@if(session('success'))
<div class="app-header st1">
  <div class="tf-container">
    <div class="tf-topbar d-flex justify-content-center align-items-center">
      <a href="#" class="back-btn"><i class="icon-left white_color"></i></a>
      <h3 class="white_color">Top Up</h3>
    </div>
  </div>
</div>
<div class="bill-payment-content">
  <div class="tf-container">
    <div class="wrapper-bill">
      <div class="archive-top">
        <span class="circle-box lg bg-circle check-icon">

        </span>
        <h1>
          <a href="#" class="success_color">
            @if(session('success'))
            {{ session('success') }}
            @endif
          </a>
        </h1>
        <h3 class="mt-2 fw_6">Top Up Berhasil</h3>
        <p class="fw_4 mt-2">Pantau transaksi anda di menu history!</p>
      </div>
      <div class="dashed-line"></div>
    </div>
  </div>
</div>
@else
{{-- larikan ke home --}}
@php
echo "<script>
  window.location.href = '/';
</script>";
@endphp
@endif
@endsection