@extends('pengguna.layouts.index')
@section('content')

<div class="mt-5">
  <div class="wrap-success">
    <div class="success_box">
      <div class="icon-1 ani3">
        <span class="circle-box lg bg-circle check-icon"></span>
      </div>
      <div class="icon-2 ani5">
        <span class="circle-box md bg-circle"></span>
      </div>
      <div class="icon-3 ani8">
        <span class="circle-box md bg-circle"></span>
      </div>
      <div class="icon-4 ani2">
        <span class="circle-box sm bg-circle"></span>
      </div>


      <div class="content">
        <div class="top">
          <h2>Berhasil!</h2>
          <p>Transaksi berhasil!</p>
        </div>
        <div class="tf-spacing-16"></div>
        <div class="inner">
          <p class="secondary_color fw_6">Total top up</p>
          <h1>Rp. {{ number_format($transaction->nominal, 0, ',', '.') }}</h1>
        </div>


      </div>
      <a href="{{ route('home') }}" class="tf-btn accent large">Done</a>

    </div>

    <span class="line-through through-1"></span>
    <span class="line-through through-2"></span>
    <span class="line-through through-3"></span>
    <span class="line-through through-4"></span>
    <span class="line-through through-5"></span>
    <span class="line-through through-6"></span>

  </div>
</div>
@endsection