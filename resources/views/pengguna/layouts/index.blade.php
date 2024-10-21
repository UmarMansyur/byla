<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport"
    content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, viewport-fit=cover">
  <title>Home</title>
  <link rel="shortcut icon" href="{{ asset('/images/icons/icon-512-512.png') }}" />
  <link rel="apple-touch-icon-precomposed" href="{{ asset('/images/icons/icon-512-512.png') }}" />
  <link rel="stylesheet" href="{{ asset('assets/fonts/fonts.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/fonts/icons-alipay.css') }}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
  <link rel="stylesheet" href="{{ asset('assets/styles/bootstrap.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/styles/swiper-bundle.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/styles.css') }}" />
  <link rel="manifest" href="{{ asset('assets/_manifest.json') }}" data-pwa-version="set_in_manifest_and_pwa_js">
  <link rel="apple-touch-icon" sizes="192x192" href="{{ asset('assets/app/icons/icon-192x192.png') }}">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  @laravelPWA
  @vite('resources/js/app.js')
</head>

<body>
  {{-- <div class="preload preload-container">
    <div class="preload-logo">
      <div class="spinner"></div>
    </div>
  </div> --}}
  @yield('content')
  <script type="text/javascript" src="{{ asset('assets/javascript/jquery.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('assets/javascript/bootstrap.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('assets/javascript/swiper-bundle.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('assets/javascript/swiper.js') }}"></script>
  <script type="text/javascript" src="{{ asset('assets/javascript/main.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script src="https://unpkg.com/jscroll@2.4.1/dist/jquery.jscroll.min.js"></script>
  <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
  <script src="https://js.pusher.com/beams/1.0/push-notifications-cdn.js"></script>
  @stack('script')

</body>

</html>