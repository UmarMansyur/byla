@extends('pengguna.layouts.index')
@section('content')
@section('title-page', 'Transfer')
@include('pengguna.layouts.back')
<div class="header">
  <div class="tf-container">
      <div class="tf-statusbar d-flex justify-content-center align-items-center">
          <a href="#" class="back-btn"> <i class="icon-left"></i> </a>
          <h3>Transfer</h3>
      </div>
  </div>
</div>
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
@if(request()->query('kode_user'))
<div class="mt-5">
  <div class="tf-container">
    <form class="tf-form" action="{{ route('Transfer QR') }}" method="POST">
      @csrf
      <div class="group-input">
        <input type="hidden" id="kode_user" name="kode_user" value="{{ request()->query('kode_user') }}">
        <label for="nominal">Nominal</label>
        <input type="text" id="nominal" name="nominal" placeholder="Masukkan nominal transfer">
      </div>
      <div class="group-input">
        <label for="pin">PIN</label>
        <input type="password" id="pin" name="pin" placeholder="Masukkan PIN">
      </div>
      <button type="submit" class="tf-btn accent medium">Transfer</button>
    </form>
  </div>
</div>
@endif
@endsection

@push('script')
<script>
  // Check for success message
  @if(session('success'))
    setTimeout(function() {
      window.location.href = '{{ route('home') }}';
    }, 3000);
  @endif

  // Check for error message
  @if(session('error'))
    setTimeout(function() {
      window.location.href = '{{ route('home') }}';
    }, 3000);
  @endif

  // Redirect if no success/error messages and no kode_user
  @if(!session('success') && !session('error') && !request()->query('kode_user'))
    window.location.href = '{{ route('home') }}';
  @endif
</script>
@endpush
