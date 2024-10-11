@extends('pengguna.layouts.index')
@section('content')
@section('title-page', 'QR Code')
@include('pengguna.layouts.back')
<div class="app-content mt-3">
    <div class="tf-container">
        <h2 class="fw_2 text-center">Screen Your QR Code</h2>
        <div class="d-flex flex-column justify-content-center align-items-center mt-5" id="qrcode">
            {!! $qrcode !!}
        </div>
    </div>
    <div class="bottom-navigation-bar bottom-btn-fixed">
        <div class="tf-container d-flex gap-3">
            <a href="{{ route('My QR Code Page') }}" class="tf-btn accent medium">Payment QR</a>
            <a href="{{ route('Scan QR Page') }}" class="tf-btn outline medium" onclick="openScan()">Scan QR</a>
        </div>
    </div>
</div>
@endsection