@extends('pengguna.layouts.index')
@section('content')
<div class="header">
  <div class="tf-container h-100">
    <div class="tf-statusbar d-flex align-items-center">
      <a href="{{ route('home') }}" class="float-start"> <i class="icon-left"></i> </a>
      <h3 class="mx-auto">Tokoku</h3>
    </div>
  </div>
</div>
@if(!Auth::user()->merchant)
@if(session('error'))
<div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="d-flex justify-content-center align-items-center flex-column" style="height: 100vh !important;">
  <img src="/assets/images/stores/store.svg" alt="product" class="img-fluid mx-auto" style="max-width: 80%;">
  <a href="{{ route('Store Activate Page') }}" class="tf-btn outline mt-3 py-3" style="width: 80%;">
    Aktivasi Toko Sekarang
  </a>
</div>
@else
@if(session('error'))
<div class="alert alert-warning">{{ session('error') }}</div>
@endif
<div class="mt-1">
  <div class="tf-container">
    <div class="box-user">
      <div class="inner d-flex flex-column align-items-center justify-content-center">
        <div class="box-avatar">
          <img src="{{ $merchant->thumbnail }}" alt="image">
          <span class="icon-camera-to-take-photos"></span>
        </div>
        <div class="info text-center">
          <h2 class="fw_8 mt-3 text-center">{{ $merchant->name }} 
            <a href="{{ route('Edit Store Page', $merchant->id) }}">
              <i class="bx bx-edit" style="font-size: 1.2rem;"></i>
            </a>
            <br>
            @if($merchant->is_verified)
            <span class="badge bg-success fs-12" style="font-size: 12px !important;">Verified</span>
            @else
            <span class="badge bg-danger fs-12" style="font-size: 12px !important;">Unverified</span>
            @endif
          </h2>
          <div class="text-muted">{{ $merchant->address }}</div>
        </div>
      </div>
    </div>
    <ul class="mt-7">
      <li class="list-user-info"><span class="icon-user"></span>{{ $merchant->name }}</li>
      <li class="list-user-info"><span class="icon-location"></span>{{ $merchant->address }}</li>
      <li class="list-user-info"><i class="bx bx-note" style="font-size: 1.2rem;"></i> {{ $merchant->description }}</li>
    </ul>
  </div>
</div>
@endif
@endsection