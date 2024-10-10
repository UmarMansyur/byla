<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
  <meta charset="utf-8" />
  <title>LOGIN | Authentication Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description"
    content="Byla merupakan platform transaksi digital yang berbasis website dan mobile app untuk UMKM" />
  <meta name="author" content="ProJs Universitas Madura" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <link rel="shortcut icon" href="/admin/images/only-logo.svg">
  @notifyCss
  <link href="/admin/css/vendor.min.css" rel="stylesheet" type="text/css" />
  <link href="/admin/css/icons.min.css" rel="stylesheet" type="text/css" />
  <link href="/admin/css/app.min.css" rel="stylesheet" type="text/css" />
  <script src="/admin/js/config.js"></script>
</head>

<body class="h-100">
  <div class="relative" style="z-index: 10000 !important;">
    <x-notify::notify />
  </div>
  <div class="d-flex flex-column h-100 p-3">
    <div class="d-flex flex-column flex-grow-1">
      <div class="row justify-content-center align-items-center h-100">
        <div class="col-xxl-4">
          <div class="card">
            <div class="card-body">
              <div class="row justify-content-center align-items-center h-100">
                <div class="col-lg-12 p-4">
                  <div class="d-flex flex-column h-100 justify-content-center">
                    <div class="auth-logo mb-4">
                      <a href="index.html" class="logo-dark">
                        <img src="/admin/images/logo.svg" alt="logo dark">
                      </a>
                    </div>
                    <h2 class="fw-bold fs-24">Login</h2>
                    <p class="text-muted mt-1 mb-4">
                      Silahkan masukkan username dan password untuk mengakses halaman admin
                    </p>
                    <div>
                      <form action="{{ route('admin.login') }}" class="authentication-form" method="POST">
                        @csrf
                        <div class="mb-3">
                          <label class="form-label" for="usernam">Username</label>
                          <input type="name" id="usernam" name="username" class="form-control"
                            placeholder="Enter your username">
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="password">Password</label>
                          <input type="password" id="password" name="password" class="form-control"
                            placeholder="Enter your password">
                        </div>
                        <div class="mb-3">
                          <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="checkbox-signin">
                            <label class="form-check-label" for="checkbox-signin">Remember Me</label>
                          </div>
                        </div>
                        <div class="mb-1 text-center d-grid">
                          <button class="btn btn-soft-primary" type="submit">Login</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  @notifyJs
  <script src="/admin/js/vendor.js"></script>
  <script src="/admin/js/app.js"></script>
</body>

</html>