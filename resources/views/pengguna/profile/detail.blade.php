@section('content')
@extends('pengguna.layouts.index')
@section('title-page', 'Profile')
@include('pengguna.layouts.back')
<div class="app-content mt-3">
  <div class="tf-container">
    <div class="box-user">
      <div class="inner d-flex flex-column align-items-center justify-content-center">
        <div class="box-avatar">
          <img src="{{ asset(Auth::user()->thumbnail) }}" alt="image">
          <span class="icon-camera-to-take-photos"></span>
        </div>
        <div class="info text-center">
          <h2 class="fw_8 mt-3 text-center">{{ Auth::user()->name }} <i class="bx bx-pencil" style="cursor: pointer;" onclick="editProfile()"></i></h2>
          <div class="text-center">
            {{ Auth::user()->user_code }}
            <i class="icon-copy1" style="cursor: pointer;" onclick="copyToClipboard('{{ Auth::user()->user_code }}')"></i>
          </div>
        </div>
      </div>
    </div>
    <ul class="mt-7">
      <li class="list-user-info">
        <span class="icon-user"></span>
        {{ Auth::user()->name }}
      </li>
      <li class="list-user-info">
        <i class="bx bx-id-card fs-4"></i>
        {{ Auth::user()->user_code }}
      </li>
      <li class="list-user-info">
        <i class="bx bx-male-female fs-4"></i>
        {{ Auth::user()->gender == 'male' ? 'Laki-laki' : 'Perempuan' }}
      </li>
      <li class="list-user-info">
        <span class="icon-calendar"></span>
        {{ \Carbon\Carbon::parse(Auth::user()->birthday)->format('d M Y') }}
      </li>
      <li class="list-user-info">
        <span class="icon-location"></span>
        {{ Auth::user()->address ?? '-' }}
      </li>
      <li class="list-user-info"><span class="icon-phone"></span>{{ Auth::user()->phone ?? '-' }}</li>
      <li class="list-user-info"><span class="icon-email"></span>{{ Auth::user()->email ?? '-' }}</li>
    </ul>
  </div>

</div>
@include('pengguna.layouts.bottom')
@endsection

@push('script')
<script>
  function copyToClipboard(text) {
    navigator.clipboard.writeText(text);
  }

  function editProfile() {
    window.location.href = "{{ route('Profile Update Page') }}";
  }
</script>
@endpush