@extends('pengguna.layouts.index')
@section('content')
<div class="app-header">
  <div class="tf-container">
    <div class="tf-topbar d-flex justify-content-between align-items-center">
      <a class="user-info d-flex justify-content-between align-items-center" href="{{ route('Profile Page') }}">
        @if (Auth::user())
        <img
          src="{{ Str::startsWith(Auth::user()->thumbnail, 'https') ? Auth::user()->thumbnail : asset('storage/' . Auth::user()->thumbnail) }}"
          alt="image">
        @else
        <img src="https://ik.imagekit.io/8zmr0xxik/blob_c2rRi4vdU?updatedAt=1709077347010" alt="image">
        @endif
        <div class="content">
          <h4 class="white_color">{{ Auth::user()->name ?? 'Pengguna' }}</h4>
          @if (!Auth::user())
          <p class="white_color fw_4">Ayo gunakan Byla disetiap transaksi kamu!</p>
          @else
          <p class="white_color fw_4">Selamat Datang Kembali!</p>
          @endif
        </div>
      </a>
      <div class="d-flex align-items-center gap-4">
        <a href="#" id="btn-popup-up" class="icon-notification1 me-2"><span>{{ $notify }}</span></a>
        @if (Auth::user())
        <a href="{{ route('Logout Pengguna') }}" style="color: white; font-size: 28px;">
          <i class="bx bx-power-off"></i>
        </a>
        @else
        <a href="{{ route('Login Pengguna') }}" style="color: white; font-size: 28px;">
          <i class="bx bx-log-in-circle"></i>
        </a>
        @endif
      </div>
    </div>
  </div>
</div>
<div class="card-secton">
  <div class="tf-container">
    <div class="tf-balance-box">
      <div class="balance">
        <div class="row">
          <div class="col-12">
            <div class="inner-left">
              <p>Saldo Kamu:</p>
              <h3>Rp. {{ number_format(Auth::user()->saldo->saldo ?? 0, 0, ',', '.') }}</h3>
            </div>
          </div>
        </div>
      </div>
      <div class="wallet-footer">
        <ul class="d-flex justify-content-between align-items-center">
          <li class="wallet-card-item">
            <a href="javascript:void(0);" class="fw_6 text-center" id="btn-popup-down">
              <ul class="icon icon-group-transfers">
                <li class="path1"></li>
                <li class="path2"></li>
                <li class="path3"></li>
              </ul>
              Transfer
            </a>
          </li>
          <li class="wallet-card-item"><a class="fw_6" href="{{ route('Topup Page') }}">
              <ul class="icon icon-topup">
                <li class="path1"></li>
                <li class="path2"></li>
                <li class="path3"></li>
                <li class="path4"></li>
              </ul>
              Top up
            </a></li>
          <li class="wallet-card-item"><a class="fw_6" href="{{ route('My QR Code Page')}}">
              <ul class="icon icon-my-qr">
                <li class="path1"></li>
                <li class="path2"></li>
                <li class="path3"></li>
                <li class="path4"></li>
                <li class="path5"></li>
                <li class="path6"></li>
                <li class="path7"></li>
              </ul>
              My QR
            </a></li>
        </ul>
      </div>
    </div>
  </div>

</div>
<div class="mt-5">
  <div class="tf-container">
    <div class="tf-title d-flex justify-content-between">
      <h3 class="fw_6">Layanan Kami</h3>
    </div>
    <ul class="box-service mt-3">
      <li>
        <a href="{{ route('Store Page') }}">
          <div class="icon-box bg_color_8">
            <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path
                d="M19.7505 19.874V22.8748C19.7497 23.0819 19.9169 23.2504 20.124 23.2512H21.6248C21.8319 23.2505 21.9991 23.0819 21.9983 22.8748V19.874H19.7505Z"
                fill="#5A626E" />
              <path
                d="M20.4985 19.874V22.8748C20.4993 23.0819 20.3321 23.2505 20.125 23.2512H21.625C21.8321 23.2505 21.9993 23.0819 21.9985 22.8748V19.874H20.4985Z"
                fill="#515763" />
              <path d="M19.7505 19.874V20.9998H21.9983V19.874H19.7505Z" fill="#515763" />
              <path d="M3.24951 6.37598V12.7484H3.9997V6.37598H3.24951Z" fill="#E7EBEF" />
              <path
                d="M6.61841 8.24421C6.51946 8.24615 6.42529 8.28712 6.35642 8.35818C6.28755 8.42925 6.24956 8.52463 6.25073 8.62359V9.00006H5.87353C5.77459 9.00046 5.6798 9.03996 5.60984 9.10993C5.53987 9.17989 5.50039 9.27465 5.5 9.3736V12.3743C5.49991 12.4674 5.53442 12.5572 5.59682 12.6262C5.65922 12.6952 5.74505 12.7386 5.83765 12.7479C5.8496 12.7484 5.86158 12.7484 5.87353 12.7479H7.37427C7.47372 12.7482 7.56925 12.7091 7.63985 12.639C7.71045 12.569 7.75033 12.4738 7.75073 12.3743V9.3736C7.75034 9.27414 7.71046 9.17894 7.63986 9.10889C7.56926 9.03884 7.47372 8.99968 7.37427 9.00006H7.00073V8.62359C7.00133 8.57335 6.99182 8.52354 6.97278 8.47704C6.95374 8.43055 6.92555 8.38834 6.88989 8.35295C6.85423 8.31756 6.81183 8.28971 6.76519 8.27103C6.71855 8.25235 6.66864 8.24323 6.61841 8.24421Z"
                fill="#FB4F56" />
              <path
                d="M9.6189 8.24421C9.51995 8.24615 9.42578 8.28712 9.35691 8.35818C9.28804 8.42925 9.25005 8.52463 9.25122 8.62359V9.00006H8.87403C8.77508 9.00046 8.68029 9.03991 8.61033 9.10988C8.54036 9.17985 8.50088 9.27465 8.50049 9.3736V12.3743C8.5004 12.4674 8.5349 12.5572 8.59731 12.6262C8.65971 12.6952 8.74554 12.7386 8.83813 12.7479C8.85009 12.7484 8.86207 12.7484 8.87402 12.7479H10.3748C10.4737 12.7475 10.5685 12.708 10.6384 12.638C10.7084 12.568 10.7479 12.4733 10.7483 12.3743V9.3736C10.7479 9.27465 10.7084 9.17989 10.6385 9.10993C10.5685 9.03996 10.4737 9.00046 10.3748 9.00006H10.0012V8.62359C10.0018 8.57335 9.99231 8.52354 9.97327 8.47704C9.95423 8.43055 9.92605 8.38834 9.89038 8.35295C9.85472 8.31756 9.81232 8.28971 9.76568 8.27103C9.71904 8.25235 9.66913 8.24323 9.6189 8.24421Z"
                fill="#FCB860" />
              <path
                d="M12.249 5.24902V12.3747C12.2498 12.5818 12.4184 12.7491 12.6255 12.7483H21.6248C21.8307 12.7475 21.9975 12.5807 21.9983 12.3747V5.24902H12.249Z"
                fill="#E7EBEF" />
              <path d="M12.999 5.62598H21.2512L21.2498 8.62451H12.9976L12.999 5.62598Z" fill="#68B1FC" />
              <path d="M12.9976 9.37451H21.2498L21.2513 12.001H12.9991L12.9976 9.37451Z" fill="#68B1FC" />
              <path
                d="M21.9971 14.1235C21.9979 13.9164 21.8306 13.7478 21.6234 13.7471H3.62453C3.41627 13.7463 3.24725 13.9153 3.24805 14.1235L3.24947 19.8737C3.24866 20.0819 3.41769 20.251 3.62594 20.2502L21.9998 20.2496L21.9971 14.1235Z"
                fill="#FCB860" />
              <path
                d="M21.9985 13.8753C21.9997 13.6679 21.8324 13.4989 21.625 13.498H20.125C20.3324 13.4988 20.4997 13.6679 20.4985 13.8753L20.4986 19.8738C20.4993 20.0809 20.3321 20.2494 20.125 20.2503L22 20.2495L21.9985 13.8753Z"
                fill="#FBB04F" />
              <path
                d="M8.12445 16.499C6.26493 16.499 4.75 18.014 4.75 19.8735C4.75 21.733 6.26493 23.2507 8.12445 23.2507C9.98397 23.2507 11.4989 21.733 11.4989 19.8735C11.4989 18.014 9.98397 16.499 8.12445 16.499Z"
                fill="#5A626E" />
              <path
                d="M3.62623 13.4981C3.57661 13.4978 3.52743 13.5074 3.48154 13.5262C3.43565 13.5451 3.39395 13.5728 3.35887 13.6079C3.32378 13.643 3.29601 13.6847 3.27716 13.7306C3.2583 13.7765 3.24874 13.8256 3.24903 13.8753V14.9988H21.9983V13.8753C21.9986 13.826 21.9891 13.7771 21.9705 13.7314C21.9519 13.6858 21.9244 13.6442 21.8897 13.6092C21.8551 13.5742 21.8138 13.5463 21.7683 13.5272C21.7229 13.5082 21.6741 13.4982 21.6248 13.4981H3.62623Z"
                fill="#FBB04F" />
              <path
                d="M2.46321 12.0009C2.37057 12.0102 2.28469 12.0536 2.22227 12.1226C2.15985 12.1917 2.12535 12.2815 2.12549 12.3746V13.875C2.12584 13.974 2.16533 14.0688 2.23533 14.1388C2.30534 14.2088 2.40019 14.2484 2.4992 14.2487H22.7486C22.7979 14.2489 22.8467 14.2394 22.8923 14.2207C22.9379 14.202 22.9793 14.1745 23.0143 14.1398C23.0493 14.1051 23.077 14.0639 23.0961 14.0184C23.1151 13.973 23.1249 13.9243 23.1251 13.875V12.3746C23.1249 12.3254 23.1151 12.2766 23.0961 12.2312C23.077 12.1857 23.0493 12.1445 23.0143 12.1098C22.9793 12.0751 22.9379 12.0476 22.8923 12.0289C22.8467 12.0102 22.7979 12.0007 22.7486 12.0009H2.4992C2.48721 12.0003 2.4752 12.0003 2.46321 12.0009Z"
                fill="#FCB860" />
              <path
                d="M21.2485 12.001C21.2978 12.0007 21.3467 12.0101 21.3924 12.0288C21.438 12.0474 21.4796 12.0749 21.5146 12.1095C21.5496 12.1442 21.5775 12.1855 21.5965 12.231C21.6156 12.2764 21.6255 12.3252 21.6257 12.3745V13.8752C21.6255 13.9245 21.6156 13.9733 21.5965 14.0188C21.5775 14.0643 21.5496 14.1056 21.5146 14.1402C21.4796 14.1749 21.438 14.2024 21.3924 14.221C21.3467 14.2396 21.2978 14.2491 21.2485 14.2488H22.7485C22.7978 14.2491 22.8467 14.2396 22.8924 14.221C22.938 14.2024 22.9796 14.1749 23.0146 14.1402C23.0496 14.1056 23.0775 14.0643 23.0965 14.0188C23.1156 13.9733 23.1255 13.9245 23.1257 13.8752V12.3745C23.1255 12.3252 23.1156 12.2764 23.0965 12.231C23.0775 12.1855 23.0496 12.1442 23.0146 12.1095C22.9796 12.0749 22.938 12.0474 22.8924 12.0288C22.8467 12.0101 22.7978 12.0007 22.7485 12.001H21.2485Z"
                fill="#FBB04F" />
              <path
                d="M8.12402 18.373C7.30004 18.373 6.62402 19.0498 6.62402 19.8738C6.62402 20.6977 7.30004 21.3738 8.12402 21.3738C8.94801 21.3738 9.62475 20.6977 9.62475 19.8738C9.62475 19.0498 8.94801 18.373 8.12402 18.373Z"
                fill="#E7EBEF" />
              <path
                d="M8.12402 16.499C7.99714 16.499 7.87233 16.5075 7.74902 16.521C9.43276 16.7085 10.7483 18.1414 10.7483 19.874C10.7483 21.6066 9.43276 23.0413 7.74902 23.2292C7.87233 23.2434 7.99714 23.2512 8.12402 23.2512C9.98354 23.2512 11.4983 21.7335 11.4983 19.874C11.4983 18.0145 9.98354 16.499 8.12402 16.499Z"
                fill="#515763" />
              <path d="M20.5 5.62451L21.2514 5.62594L21.25 8.62443L20.4985 8.623L20.5 5.62451Z" fill="#4FA4FB" />
              <path d="M20.4985 9.37305L21.25 9.37447L21.2516 12.0009L20.5001 11.9995L20.4985 9.37305Z"
                fill="#4FA4FB" />
              <path
                d="M3.99792 0.749512C3.86951 0.750631 3.7507 0.817701 3.68298 0.926764L1.80579 3.9275C1.76342 3.99582 1.74414 4.07592 1.7508 4.15601V4.87375C1.7508 5.90602 2.59207 6.75099 3.62433 6.75099C4.23934 6.75099 4.78228 6.45868 5.12434 5.99803C5.46721 6.45847 6.01024 6.75099 6.62507 6.75099C7.23971 6.75099 7.78225 6.45896 8.12433 5.99877C8.46643 6.45896 9.00824 6.75099 9.62287 6.75099C10.2377 6.75099 10.7815 6.45852 11.1243 5.99803C11.4664 6.45868 12.0093 6.75099 12.6243 6.75099C13.2392 6.75099 13.7822 6.45852 14.1251 5.99803C14.4671 6.45868 15.0093 6.75099 15.6243 6.75099C16.2393 6.75099 16.7823 6.45868 17.1243 5.99803C17.4672 6.45852 18.0109 6.75099 18.6258 6.75099C19.2404 6.75099 19.7822 6.45896 20.1243 5.99877C20.4664 6.45896 21.009 6.75099 21.6236 6.75099C22.6559 6.75099 23.5001 5.90602 23.5001 4.87375V4.12673C23.5003 4.0458 23.4744 3.96685 23.4261 3.90185L21.5679 0.926764C21.4995 0.816638 21.379 0.749512 21.2493 0.749512H3.99792Z"
                fill="#FC6067" />
              <path
                d="M1.75287 4.125C1.75286 4.13492 1.74989 4.14541 1.7506 4.15575V4.8735C1.7506 5.90576 2.59186 6.75073 3.62413 6.75073C4.23913 6.75073 4.78208 6.45842 5.12413 5.99778C5.467 6.45821 6.01003 6.75073 6.62486 6.75073C7.2395 6.75073 7.78204 6.45871 8.12413 5.99851C8.46623 6.45871 9.00804 6.75073 9.62266 6.75073C10.2375 6.75073 10.7813 6.45827 11.1241 5.99778C11.4662 6.45842 12.0091 6.75073 12.6241 6.75073C13.239 6.75073 13.782 6.45827 14.1249 5.99778C14.4669 6.45842 15.0091 6.75073 15.6241 6.75073C16.2391 6.75073 16.7821 6.45842 17.1241 5.99778C17.467 6.45827 18.0107 6.75073 18.6256 6.75073C19.2402 6.75073 19.782 6.45871 20.1241 5.99851C20.4662 6.45871 21.0088 6.75073 21.6234 6.75073C22.6557 6.75073 23.4999 5.90575 23.4999 4.8735V4.12643C23.4999 4.12606 23.4999 4.12534 23.4999 4.12504L1.75287 4.125Z"
                fill="#FB4F56" />
              <path
                d="M6.81201 0.749512L5.12451 4.12526V5.99803C5.46737 6.45847 6.01042 6.75099 6.62524 6.75099C7.23988 6.75099 7.78242 6.45896 8.12451 5.99877V4.12526L9.39014 0.749512H6.81201ZM11.5464 0.749512L11.1245 4.12526V5.99803C11.4666 6.45868 12.0095 6.75099 12.6245 6.75099C13.239 6.75099 13.7816 6.45879 14.1245 5.99877V4.12526L13.7026 0.749512H11.5464ZM15.8596 0.749512L17.1252 4.12526V5.99877C17.4673 6.45896 18.0099 6.75099 18.6245 6.75099C19.2393 6.75099 19.7824 6.45847 20.1252 5.99803V4.12526L18.4377 0.749512H15.8596Z"
                fill="#E7EBEF" />
              <path
                d="M5.12451 4.125V5.99778C5.46737 6.45821 6.01042 6.75073 6.62524 6.75073C7.23988 6.75073 7.78242 6.45871 8.12451 5.99851V4.125H5.12451ZM11.1245 4.125V5.99778C11.4666 6.45842 12.0095 6.75073 12.6245 6.75073C13.239 6.75073 13.7816 6.45854 14.1245 5.99851V4.125H11.1245ZM17.1252 4.125V5.99851C17.4673 6.45871 18.0099 6.75073 18.6245 6.75073C19.2393 6.75073 19.7824 6.45821 20.1252 5.99778V4.125H17.1252Z"
                fill="#DBE1E7" />
              <path
                d="M19.7495 0.749512C19.8792 0.749526 19.9997 0.816553 20.0681 0.926764L21.9263 3.90185C21.9746 3.96691 22.0005 4.04574 22.0002 4.12673H23.5002C23.5005 4.0458 23.4746 3.96685 23.4263 3.90185L21.5681 0.926764C21.4997 0.816638 21.3792 0.749526 21.2495 0.749512H19.7495Z"
                fill="#FB4F56" />
              <path
                d="M22.0002 4.12549V4.87364C22.0002 5.63956 21.5346 6.30089 20.873 6.59192C20.8738 6.59223 20.8746 6.59229 20.8753 6.59265C20.9299 6.61647 20.986 6.6376 21.043 6.65645C21.0504 6.65929 21.0576 6.66071 21.065 6.66355C21.117 6.67999 21.1701 6.69402 21.224 6.70606C21.2416 6.71032 21.2596 6.71172 21.2774 6.71597C21.3248 6.72447 21.3724 6.73398 21.421 6.73937C21.4877 6.74646 21.5552 6.7507 21.6239 6.7507C22.6561 6.7507 23.5003 5.90576 23.5003 4.87351V4.12562L22.0002 4.12549Z"
                fill="#FB3B43" />
            </svg>

          </div>
          Tokoku
        </a>
      </li>
      <li>
        <a href="{{ route('Product Page') }}">
          <div class="icon-box bg_color_1">
            <i class='bx bxs-offer text-danger' style="font-size: 1.5rem;"></i>
          </div>
          Produk
        </a>
      </li>
      <li>
        <a href="{{ route('Stock Management Page') }}">
          <div class="icon-box bg_color_3">
            <i class='bx bxl-slack-old' style="font-size: 1.5rem;"></i>
          </div>
          Manajemen Stok
        </a>
      </li>
      <li>
        <a href="{{ route('Transaction Page') }}">
          <div class="icon-box bg_color_4">
            <i class='bx bx-cart' style="font-size: 1.5rem;"></i>
          </div>
          Transaksi
        </a>
      </li>

    </ul>
  </div>
</div>
<div class="mt-5 mb-9">
  <div class="tf-container">
    <div class="mt-5">
      <div class="swiper-container banner-tes">
        <div class="swiper-wrapper">
          <div class="swiper-slide">
            <img src="/assets/images/banner/banner.jpg" alt="images">
          </div>
          <div class="swiper-slide">
            <img src="/assets/images/banner/banner2.jpg" alt="images">
          </div>
          <div class="swiper-slide">
            <img src="/assets/images/banner/banner3.jpg" alt="images">
          </div>
          <div class="swiper-slide">
            <img src="/assets/images/banner/banner2.jpg" alt="images">
          </div>
          <div class="swiper-slide">
            <img src="/assets/images/banner/banner3.jpg" alt="images">
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
@include('pengguna.layouts.bottom')
<div class="tf-panel up">
  <div class="panel-box panel-up panel-noti">
    <div class="header is-fixed">
      <div class="tf-container">
        <div class="tf-statusbar d-flex justify-content-center align-items-center">
          <a href="#" class="clear-panel"> <i class="icon-left"></i> </a>
          <h3>Notification</h3>
        </div>
      </div>
    </div>
    <div id="app-wrap" class="style1">
      <div class="tf-container">
        <div class="tf-tab mt-3">
          <div class="swiper-container tes-noti">
            <ul class="swiper-wrapper menu-tabs">
              <li class="swiper-slide nav-tab active "><a href="#">Semua Notifikasi</a></li>
              <li class=" swiper-slide nav-tab "><a href="#">Belum Dibaca</a></li>
              <li class="swiper-slide nav-tab"><a href="#">Dibaca</a></li>
            </ul>
          </div>
          @if(Auth::user())
          <div class="content-tab mt-5">
            <div class="noti-box infinite-scroll">
              @foreach ($notify_list as $notify)
              <a href="javascript:void(0)" class="noti-list" onclick="read_notif({{ $notify->id }}, '{{ $notify->url }}')">
                <div class="icon-box bg_service-4">
                  <i class="bx bx-bell"></i>
                </div>
                <div class="content-right">
                  <div class="title">
                    <h3 class="fw_6">
                      {{ $notify->title }}
                    </h3>
                    <span class="fw_6 on_surface_color">
                      {{ $notify->created_at->diffForHumans() }}
                    </span>
                  </div>
                  <div class="desc">
                    <p class="on_surface_color fw_4">
                      {{ $notify->content }}
                    </p>
                    <i class="dot"></i>
                  </div>
                </div>
              </a>
              @endforeach
            </div>
            <!-- 2 -->
            <div class="noti-box infinite-scroll">
              @foreach ($notify_list as $notify)
              @if($notify->is_read == false)
              <a href="javascript:void(0)" class="noti-list" onclick="read_notif({{ $notify->id }}, '{{ $notify->url }}')">
                <div class="icon-box bg_service-4">
                  <i class="bx bx-bell"></i>
                </div>
                <div class="content-right">
                  <div class="title">
                    <h3 class="fw_6">
                      {{ $notify->title }}
                    </h3>
                    <span class="fw_6 on_surface_color">
                      {{ $notify->created_at->diffForHumans() }}
                    </span>
                  </div>
                  <div class="desc">
                    <p class="on_surface_color fw_4">
                      {{ $notify->content }}
                    </p>
                    <i class="dot"></i>
                  </div>
                </div>
              </a>
              @endif
              @endforeach
              <div class="text-center d-none">
                {{ $notify_list->links() }}
              </div>
            </div>
            <!-- 3 -->
            <div class="noti-box infinite-scroll">
              @foreach ($notify_list as $notify)
              @if($notify->is_read == true)
              <a href="javascript:void(0)" class="noti-list" onclick="read_notif({{ $notify->id }}, '{{ $notify->url }}')">
                <div class="icon-box bg_service-4">
                  <i class="bx bx-bell"></i>
                </div>
                <div class="content-right">
                  <div class="title">
                    <h3 class="fw_6">
                      {{ $notify->title }}
                    </h3>
                    <span class="fw_6 on_surface_color">
                      {{ $notify->created_at->diffForHumans() }}
                    </span>
                  </div>
                  <div class="desc">
                    <p class="on_surface_color fw_4">
                      {{ $notify->content }}
                    </p>
                    <i class="dot"></i>
                  </div>
                </div>
              </a>
              @endif
              @endforeach
              <div class="text-center d-none">
                {{ $notify_list->links() }}
              </div>
            </div>

          </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
<div class="tf-panel down">
  <div class="panel_overlay"></div>
  <div class="panel-box panel-down">
    <div class="header bg_white_color">
      <div class="tf-container">
        <div class="tf-statusbar d-flex justify-content-center align-items-center">
          <a href="#" class="clear-panel"> <i class="icon-close1"></i> </a>
          <h3>Transfer Method</h3>
          <a href="{{ route('My QR Code Page')}}" class="action-right"><i class="icon-qrcode4"></i></a>
        </div>
      </div>
    </div>
    <div class="wrap-transfer mb-5">
      <div class="tf-container">
        <a href="{{ route('My QR Code Page') }}" class="action-sheet-transfer">
          <div class="icon"><i class="icon-friends"></i></div>
          <div class="content">
            <h4 class="fw_6">Transfer ke Teman</h4>
            <p>Gratis, hanya scan QR</p>
          </div>
        </a>
        <a href="{{ route('Transfer Bank Page') }}" class="action-sheet-transfer">
          <div class="icon"><i class="icon-bank2"></i></div>
          <div class="content">
            <h4 class="fw_6">Transfer ke Bank</h4>
            <p>Transfer ke bank account, card</p>
          </div>
        </a>
      </div>
    </div>
  </div>
</div>
<div class="tf-panel card-popup">
  <div class="panel_overlay"></div>
  <div class="panel-box panel-down">
    <div class="header">
      <div class="tf-container">
        <div class="tf-statusbar d-flex justify-content-center align-items-center">
          <a href="#" class="clear-panel"> <i class="icon-left"></i> </a>
          <h3>Manage Your Card</h3>
        </div>
      </div>
    </div>
    <div class="content-card mt-3 mb-5">
      <div class="tf-container">
        <div class="tf-card-list bg_surface_color large out-line">
          <div class="logo">
            <img src="/assets/images/logo-banks/card-visa.png" alt="image">
          </div>
          <div class="info">
            <h4 class="fw_6"><a href="38_card-detail.html">Mastercard</a></h4>
            <p>**** **** **** 7576</p>
          </div>
          <input type="checkbox" class="tf-checkbox circle-check" checked>
        </div>
        <p class="auth-line">Choose other card for payment</p>
        <ul class="box-card">
          <li class="tf-card-list medium bt-line">
            <div class="logo">
              <img src="/assets/images/logo-banks/card-visa2.png" alt="image">
            </div>
            <div class="info">
              <h4 class="fw_6"><a href="38_card-detail.html">Visacard</a></h4>
              <p>**** **** **** 3245</p>
            </div>
            <input type="checkbox" class="tf-checkbox circle-check">
          </li>
          <li class="tf-card-list medium bt-line">
            <div class="logo">
              <img src="/assets/images/logo-banks/card-visa.png" alt="image">
            </div>
            <div class="info">
              <h4 class="fw_6"><a href="38_card-detail.html">Mastercard</a></h4>
              <p>**** **** **** 7576</p>
            </div>
            <input type="checkbox" class="tf-checkbox circle-check">
          </li>
          <li class="tf-card-list medium">
            <div class="logo">
              <img src="/assets/images/logo-banks/card-visa2.png" alt="image">
            </div>
            <div class="info">
              <h4 class="fw_6"><a href="38_card-detail.html">Visacard</a></h4>
              <p>**** **** **** 7214</p>
            </div>
            <input type="checkbox" class="tf-checkbox circle-check">
          </li>
        </ul>
        <div class="tf-spacing-20"></div>
        <a href="34_card.html" class="tf-btn large">Add a new card <i class="icon-plus fw_7"></i> </a>
      </div>
    </div>
  </div>

</div>
<div class="tf-panel repicient">
  <div class="panel-box panel-up">
    <div class="header-transfer header-st2">
      <div class="tf-container">
        <div class="tf-statusbar d-flex justify-content-between align-items-center">
          <a href="#" class="clear-panel"><i class="icon-left on_surface_color"></i></a>
          <h3 class="">Saved Repicients</h3>
          <a href="57_add-new-repicient.html" class="action-right"><i class="icon-plus"></i> </a>
        </div>
      </div>
    </div>

    <div class="wrap-transfer-friends mt-3">
      <div class="tf-container">
        <div class="wrap-fixed">
          <div class="input-field">
            <span class="icon-search"></span>
            <input required class="search-field value_input" placeholder="Search" type="text" value="Andy Cody">
            <span class="icon-clear"></span>
          </div>
        </div>
        <div class="tf-tab">
          <ul class="menu-tabs">
            <li class="nav-tab active">Phone</li>
            <li class="nav-tab">Bank Account</li>
          </ul>
          <div class="content-tab">
            <ul class="tabs-list-item">
              <li>
                <a href="54_repicient-detail.html" class="recipient-list">
                  <ul class="inner">
                    <li class="user">
                      <img src="/assets/images/user/user2.jpg" alt="image">
                    </li>
                    <li class="info">
                      <h4>Andy Cody</h4>
                      <p>**** **** **** 0674</p>
                    </li>
                  </ul>
                  <ul class="alphabet">
                    <li>A</li>
                    <li>B</li>
                  </ul>
                </a>
              </li>
              <li>
                <a href="54_repicient-detail.html" class="recipient-list">
                  <ul class="inner">
                    <li class="user">
                      <img src="/assets/images/user/user3.jpg" alt="image">
                    </li>
                    <li class="info">
                      <h4>Alex Tran</h4>
                      <p>**** **** **** 3216</p>
                    </li>
                  </ul>
                  <ul class="alphabet">
                    <li>C</li>
                    <li>D</li>
                  </ul>
                </a>
              </li>
              <li>
                <a href="54_repicient-detail.html" class="recipient-list">
                  <ul class="inner">
                    <li class="user">
                      <img src="/assets/images/user/user8.jpg" alt="image">
                    </li>
                    <li class="info">
                      <h4>Themesflat</h4>
                      <p>**** **** **** 0674</p>
                    </li>
                  </ul>
                  <ul class="alphabet">
                    <li>E</li>
                    <li>F</li>
                  </ul>
                </a>
              </li>
              <li>
                <a href="54_repicient-detail.html" class="recipient-list">
                  <ul class="inner">
                    <li class="user">
                      <img src="/assets/images/user/user9.jpg" alt="image">
                    </li>
                    <li class="info">
                      <h4>Albert Flores</h4>
                      <p>**** **** **** 3674</p>
                    </li>
                  </ul>
                  <ul class="alphabet">
                    <li>G</li>
                    <li>H</li>
                  </ul>
                </a>
              </li>
              <li>
                <a href="54_repicient-detail.html" class="recipient-list">
                  <ul class="inner">
                    <li class="user">
                      <img src="/assets/images/user/user10.jpg" alt="image">
                    </li>
                    <li class="info">
                      <h4>Bruce Banner</h4>
                      <p>**** **** **** 2432</p>
                    </li>
                  </ul>
                  <ul class="alphabet">
                    <li>I</li>
                    <li>I</li>
                  </ul>
                </a>
              </li>
              <li>
                <a href="54_repicient-detail.html" class="recipient-list">
                  <ul class="inner">
                    <li class="user">
                      <img src="/assets/images/user/user11.jpg" alt="image">
                    </li>
                    <li class="info">
                      <h4>Benny</h4>
                      <p>**** **** **** 2341</p>
                    </li>
                  </ul>
                  <ul class="alphabet">
                    <li>J</li>
                    <li>K</li>
                  </ul>
                </a>
              </li>
              <li>
                <a href="54_repicient-detail.html" class="recipient-list">
                  <ul class="inner">
                    <li class="user">
                      <img src="/assets/images/user/user12.jpg" alt="image">
                    </li>
                    <li class="info">
                      <h4>Christian</h4>
                      <p>**** **** **** 1255</p>
                    </li>
                  </ul>
                  <ul class="alphabet">
                    <li>L</li>
                    <li>M</li>
                  </ul>
                </a>
              </li>
              <li>
                <a href="54_repicient-detail.html" class="recipient-list">
                  <ul class="inner">
                    <li class="user">
                      <img src="/assets/images/user/user13.jpg" alt="image">
                    </li>
                    <li class="info">
                      <h4>Cameron Williamson</h4>
                      <p>**** **** **** 2352</p>
                    </li>
                  </ul>
                  <ul class="alphabet">
                    <li>O</li>
                    <li>P</li>
                  </ul>
                </a>
              </li>
              <li>
                <a href="54_repicient-detail.html" class="recipient-list">
                  <ul class="inner">
                    <li class="user">
                      <img src="/assets/images/user/user14.jpg" alt="image">
                    </li>
                    <li class="info">
                      <h4>Cody Fisher</h4>
                      <p>**** **** **** 0674</p>
                    </li>
                  </ul>
                  <ul class="alphabet">
                    <li>Q</li>
                    <li>R</li>
                  </ul>
                </a>
              </li>
              <li>
                <a href="54_repicient-detail.html" class="recipient-list">
                  <ul class="inner">
                    <li class="user">
                      <img src="/assets/images/user/user2.jpg" alt="image">
                    </li>
                    <li class="info">
                      <h4>Andy Cody</h4>
                      <p>**** **** **** 0674</p>
                    </li>
                  </ul>
                  <ul class="alphabet">
                    <li>S</li>
                    <li>T</li>
                  </ul>
                </a>
              </li>
              <li>
                <a href="54_repicient-detail.html" class="recipient-list">
                  <ul class="inner">
                    <li class="user">
                      <img src="/assets/images/user/user3.jpg" alt="image">
                    </li>
                    <li class="info">
                      <h4>Alex Tran</h4>
                      <p>**** **** **** 3216</p>
                    </li>
                  </ul>
                  <ul class="alphabet">
                    <p>U</p>
                    <P>V</P>
                  </ul>
                </a>
              </li>
              <li>
                <a href="54_repicient-detail.html" class="recipient-list">
                  <ul class="inner">
                    <li class="user">
                      <img src="/assets/images/user/user8.jpg" alt="image">
                    </li>
                    <li class="info">
                      <h4>Themesflat</h4>
                      <p>**** **** **** 0674</p>
                    </li>
                  </ul>
                  <ul class="alphabet">
                    <li>W</li>
                    <li>X</li>
                  </ul>
                </a>
              </li>
              <li>
                <a href="54_repicient-detail.html" class="recipient-list">
                  <ul class="inner">
                    <li class="user">
                      <img src="/assets/images/user/user9.jpg" alt="image">
                    </li>
                    <li class="info">
                      <h4>Albert Flores</h4>
                      <p>**** **** **** 3674</p>
                    </li>
                  </ul>
                  <ul class="alphabet">
                    <p>Y</p>
                    <P>Z</P>
                  </ul>
                </a>
              </li>
            </ul>
            <ul class="tabs-list-item">
              <li>
                <a href="54_repicient-detail.html" class="recipient-list">
                  <ul class="inner">
                    <li class="user">
                      <img src="/assets/images/user/user2.jpg" alt="image">
                    </li>
                    <li class="info">
                      <h4>Andy Cody</h4>
                      <p>**** **** **** 0674</p>
                    </li>
                  </ul>
                  <ul class="alphabet">
                    <li>A</li>
                    <li>B</li>
                  </ul>
                </a>
              </li>
              <li>
                <a href="54_repicient-detail.html" class="recipient-list">
                  <ul class="inner">
                    <li class="user">
                      <img src="/assets/images/user/user3.jpg" alt="image">
                    </li>
                    <li class="info">
                      <h4>Alex Tran</h4>
                      <p>**** **** **** 3216</p>
                    </li>
                  </ul>
                  <ul class="alphabet">
                    <li>C</li>
                    <li>D</li>
                  </ul>
                </a>
              </li>
              <li>
                <a href="54_repicient-detail.html" class="recipient-list">
                  <ul class="inner">
                    <li class="user">
                      <img src="/assets/images/user/user8.jpg" alt="image">
                    </li>
                    <li class="info">
                      <h4>Themesflat</h4>
                      <p>**** **** **** 0674</p>
                    </li>
                  </ul>
                  <ul class="alphabet">
                    <li>E</li>
                    <li>F</li>
                  </ul>
                </a>
              </li>
              <li>
                <a href="54_repicient-detail.html" class="recipient-list">
                  <ul class="inner">
                    <li class="user">
                      <img src="/assets/images/user/user9.jpg" alt="image">
                    </li>
                    <li class="info">
                      <h4>Albert Flores</h4>
                      <p>**** **** **** 3674</p>
                    </li>
                  </ul>
                  <ul class="alphabet">
                    <li>G</li>
                    <li>H</li>
                  </ul>
                </a>
              </li>
              <li>
                <a href="54_repicient-detail.html" class="recipient-list">
                  <ul class="inner">
                    <li class="user">
                      <img src="/assets/images/user/user10.jpg" alt="image">
                    </li>
                    <li class="info">
                      <h4>Bruce Banner</h4>
                      <p>**** **** **** 2432</p>
                    </li>
                  </ul>
                  <ul class="alphabet">
                    <li>I</li>
                    <li>I</li>
                  </ul>
                </a>
              </li>
              <li>
                <a href="54_repicient-detail.html" class="recipient-list">
                  <ul class="inner">
                    <li class="user">
                      <img src="/assets/images/user/user11.jpg" alt="image">
                    </li>
                    <li class="info">
                      <h4>Benny</h4>
                      <p>**** **** **** 2341</p>
                    </li>
                  </ul>
                  <ul class="alphabet">
                    <li>J</li>
                    <li>K</li>
                  </ul>
                </a>
              </li>
              <li>
                <a href="54_repicient-detail.html" class="recipient-list">
                  <ul class="inner">
                    <li class="user">
                      <img src="/assets/images/user/user12.jpg" alt="image">
                    </li>
                    <li class="info">
                      <h4>Christian</h4>
                      <p>**** **** **** 1255</p>
                    </li>
                  </ul>
                  <ul class="alphabet">
                    <li>L</li>
                    <li>M</li>
                  </ul>
                </a>
              </li>
              <li>
                <a href="54_repicient-detail.html" class="recipient-list">
                  <ul class="inner">
                    <li class="user">
                      <img src="/assets/images/user/user13.jpg" alt="image">
                    </li>
                    <li class="info">
                      <h4>Cameron Williamson</h4>
                      <p>**** **** **** 2352</p>
                    </li>
                  </ul>
                  <ul class="alphabet">
                    <li>O</li>
                    <li>P</li>
                  </ul>
                </a>
              </li>
              <li>
                <a href="54_repicient-detail.html" class="recipient-list">
                  <ul class="inner">
                    <li class="user">
                      <img src="/assets/images/user/user14.jpg" alt="image">
                    </li>
                    <li class="info">
                      <h4>Cody Fisher</h4>
                      <p>**** **** **** 0674</p>
                    </li>
                  </ul>
                  <ul class="alphabet">
                    <li>Q</li>
                    <li>R</li>
                  </ul>
                </a>
              </li>
              <li>
                <a href="54_repicient-detail.html" class="recipient-list">
                  <ul class="inner">
                    <li class="user">
                      <img src="/assets/images/user/user2.jpg" alt="image">
                    </li>
                    <li class="info">
                      <h4>Andy Cody</h4>
                      <p>**** **** **** 0674</p>
                    </li>
                  </ul>
                  <ul class="alphabet">
                    <li>S</li>
                    <li>T</li>
                  </ul>
                </a>
              </li>
              <li>
                <a href="54_repicient-detail.html" class="recipient-list">
                  <ul class="inner">
                    <li class="user">
                      <img src="/assets/images/user/user3.jpg" alt="image">
                    </li>
                    <li class="info">
                      <h4>Alex Tran</h4>
                      <p>**** **** **** 3216</p>
                    </li>
                  </ul>
                  <ul class="alphabet">
                    <p>U</p>
                    <P>V</P>
                  </ul>
                </a>
              </li>
              <li>
                <a href="54_repicient-detail.html" class="recipient-list">
                  <ul class="inner">
                    <li class="user">
                      <img src="/assets/images/user/user8.jpg" alt="image">
                    </li>
                    <li class="info">
                      <h4>Themesflat</h4>
                      <p>**** **** **** 0674</p>
                    </li>
                  </ul>
                  <ul class="alphabet">
                    <li>W</li>
                    <li>X</li>
                  </ul>
                </a>
              </li>
              <li>
                <a href="54_repicient-detail.html" class="recipient-list">
                  <ul class="inner">
                    <li class="user">
                      <img src="/assets/images/user/user9.jpg" alt="image">
                    </li>
                    <li class="info">
                      <h4>Albert Flores</h4>
                      <p>**** **** **** 3674</p>
                    </li>
                  </ul>
                  <ul class="alphabet">
                    <p>Y</p>
                    <P>Z</P>
                  </ul>
                </a>
              </li>
            </ul>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
@endsection
@push('script')
<script>
  window.onload = function() {
    const pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
      cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
    });

    const channel = pusher.subscribe('transaksi-update');
    channel.bind('transaksi-update', function(data) {
      location.reload();
    });
  }
</script>
@endpush

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
  function read_notif(id, url) {
    $.ajax({
      url: '{{ route('read_notif') }}',
      type: 'POST',
      data: {
        _token: '{{ csrf_token() }}',
        id: id
      },
      success: function(response) {
        if(response.success) {
          window.location = url;
        }
      }
    });
  }
</script>
@endpush