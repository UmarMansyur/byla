<div class="scrollbar" data-simplebar="init">
  <div class="simplebar-wrapper" style="margin: 0px;">
    <div class="simplebar-height-auto-observer-wrapper">
      <div class="simplebar-height-auto-observer"></div>
    </div>
    <div class="simplebar-mask">
      <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
        <div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content"
          style="height: 100%; overflow: hidden scroll;">
          <div class="simplebar-content" style="padding: 0px;">
            <ul class="navbar-nav" id="navbar-nav">
              <li class="menu-title">Menu</li>
              <li class="nav-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                <a class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}"
                  href="{{ route('admin.dashboard') }}">
                  <span class="nav-icon">
                    <iconify-icon icon="solar:widget-5-bold-duotone"></iconify-icon>
                  </span>
                  <span class="nav-text">Dashboard</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/admin/users">
                  <span class="nav-icon">
                    <i class="bx bx-user"></i>
                  </span>
                  <span class="nav-text">Pengguna</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/admin/merchant">
                  <span class="nav-icon">
                    <i class="bx bx-store"></i>
                  </span>
                  <span class="nav-text">Merchant</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/admin/transaksi">
                  <span class="nav-icon">
                    <iconify-icon icon="solar:wallet-bold-duotone"></iconify-icon>
                  </span>
                  <span class="nav-text">Transaksi</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/admin/laporan-transaksi">
                  <span class="nav-icon">
                    <iconify-icon icon="solar:card-transfer-bold-duotone"></iconify-icon>
                  </span>
                  <span class="nav-text">Laporan Transaksi</span>
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="/admin/setelah-pembayaran">
                  <span class="nav-icon">
                    <iconify-icon icon="solar:banknote-2-bold-duotone"></iconify-icon>
                  </span>
                  <span class="nav-text">Setelah Pembayaran</span>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="simplebar-placeholder" style="width: auto; height: 1957px;"></div>
  </div>
  <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
    <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
  </div>
  <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
    <div class="simplebar-scrollbar" style="height: 50px; transform: translate3d(0px, 140px, 0px); display: block;">
    </div>
  </div>
</div>