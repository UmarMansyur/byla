<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Mobile Specific Metas -->
  <meta name="viewport"
    content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, viewport-fit=cover">
  <title>@yield('title')</title>
  <!-- Favicon and Touch Icons  -->
  <link rel="shortcut icon" href="/assets/images/logo.png" />
  <link rel="apple-touch-icon-precomposed" href="/assets/images/logo.png" />
  <!-- Font -->
  <link rel="stylesheet" href="/assets/fonts/fonts.css" />
  <!-- Icons -->
  <link rel="stylesheet" href="/assets/fonts/icons-alipay.css">
  <link rel="stylesheet" href="/assets/styles/bootstrap.css">
  {{-- @vite('resources/js/app.js') --}}
  <link rel="stylesheet" type="text/css" href="/assets/styles/styles.css" />
  <link rel="apple-touch-icon" sizes="192x192" href="/assets/images/logo.png">
</head>

<body>
  {{-- <div class="preload preload-container">
    <div class="preload-logo">
      <div class="spinner"></div>
    </div>
  </div> --}}
  @yield('content')
  <script type="text/javascript" src="/assets/javascript/jquery.min.js"></script>
  <script type="text/javascript" src="/assets/javascript/bootstrap.min.js"></script>
  <script type="text/javascript" src="/assets/javascript/password-addon.js"></script>
  <script type="text/javascript" src="/assets/javascript/main.js"></script>
  <script type="text/javascript" src="/assets/javascript/init.js"></script>
</body>

</html>