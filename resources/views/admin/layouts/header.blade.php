<header class="topbar">
  <div class="container-fluid">
    <div class="navbar-header">
      <div class="d-flex align-items-center">
        <div class="topbar-item">
          <button type="button" class="button-toggle-menu me-2">
            <iconify-icon icon="solar:hamburger-menu-broken" class="fs-24 align-middle"></iconify-icon>
          </button>
        </div>
        <div class="topbar-item">
          <h4 class="fw-bold topbar-button pe-none text-uppercase mb-0">@yield('title')</h4>
        </div>
      </div>

      <div class="d-flex align-items-center gap-1">
        <div class="topbar-item">
          <button type="button" class="topbar-button" id="light-dark-mode">
            <iconify-icon icon="solar:moon-bold-duotone" class="fs-24 align-middle"></iconify-icon>
          </button>
        </div>

        <div class="dropdown topbar-item">
          <button type="button" class="topbar-button position-relative" id="page-header-notifications-dropdown"
            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <iconify-icon icon="solar:bell-bing-bold-duotone" class="fs-24 align-middle"></iconify-icon>
            @if(Auth::guard('admin')->user()->notifications->where('is_read', false)->count() > 0)
            <span class="position-absolute topbar-badge fs-10 translate-middle badge bg-danger rounded-pill">
              {{ Auth::guard('admin')->user()->notifications->where('is_read', false)->count() }}
                <span class="visually-hidden">notifikasi tidak dibaca</span>
              </span>
            @endif
          </button>
          <div class="dropdown-menu py-0 dropdown-menu-lg dropdown-menu-end"
            aria-labelledby="page-header-notifications-dropdown">
            <div class="p-3 border-bottom">
              <div class="row align-items-center">
                <div class="col">
                  <h6 class="m-0 fs-16 fw-semibold">Notifikasi</h6>
                </div>
                <div class="col-auto">
                  <a href="{{ route('admin.notifications.read-all') }}" class="text-muted text-decoration-underline">
                    <small>Bersihkan Semua</small>
                  </a>
                </div>
              </div>
            </div>
            <div class="notifications-list" style="width: 300px; max-height: 300px;" data-simplebar>
              @foreach(Auth::guard('admin')->user()->notifications->sortByDesc('created_at') as $notification)
                <a href="{{ route('admin.notifications.read-one', $notification->id) }}" class="dropdown-item p-3 border-bottom ">
                  <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                      @if($notification->is_read == false)
                        <div class="avatar-sm">
                          <span class="avatar-title bg-soft-primary text-primary rounded-circle fs-5">
                            <i class="bx bx-bell"></i>
                          </span>
                        </div>
                      @else
                      <div class="avatar-sm">
                        <span class="avatar-title bg-soft-success text-success rounded-circle fs-5">
                          <i class="bx bx-bell"></i>
                        </span>
                      </div>
                      @endif
                    </div>
                    <div class="flex-grow-1 ms-3">
                      <h6 class="mb-1 fs-14 text-break notification-title">{{ $notification->title }}</h6>
                      <p class=" mb-0 fs-12 text-muted d-flex flex-wrap" style="width: 200px; text-wrap: wrap;">{{ $notification->content }}</p>
                      <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                    </div>
                  </div>
                </a>
              @endforeach
            </div>

          </div>
        </div>
        <div class="dropdown topbar-item">
          <a type="button" class="topbar-button" id="page-header-user-dropdown" data-bs-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <span class="d-flex align-items-center">
              <img class="rounded-circle shadow-lg" width="32" src="{{ Auth::guard('admin')->user()->thumbnail }}" alt="avatar-3">
            </span>
          </a>
          <div class="dropdown-menu dropdown-menu-end">
            <h6 class="dropdown-header">Selamat datang {{ Auth::guard('admin')->user()->name }}!</h6>
            <a class="dropdown-item" href="{{ route('admin.profile') }}">
              <i class="bx bx-user-circle text-muted fs-18 align-middle me-1"></i><span
                class="align-middle">Profil</span>
            </a>

            <div class="dropdown-divider my-1"></div>

            <a class="dropdown-item text-danger" href="{{ route('Administrator Logout') }}">
              <i class="bx bx-log-out fs-18 align-middle me-1"></i><span class="align-middle">Logout</span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>
