<div class="bottom-navigation-bar">
  <div class="tf-container">
    <ul class="tf-navigation-bar">
      <li class="{{ request()->is('/') ? 'active' : '' }}">
        <a class="fw_6 d-flex justify-content-center align-items-center flex-column" href="{{ route('home') }}">
          <i class="{{ request()->is('/') ? 'icon-home2' : 'icon-home' }}" style="font-size: 24px !important;"></i> Beranda</a>
      </li>
      <li class="{{ request()->is('history') ? 'active' : '' }}">
        <a class="fw_4 d-flex justify-content-center align-items-center flex-column" href="{{ route('History Page') }}"><i
            class="{{ request()->is('history') ? 'icon-history text-primary' : 'icon-history' }}"></i>
          History</a>
      </li>
      <li>
        <a class="fw_4 d-flex justify-content-center align-items-center flex-column" href="{{ route('My QR Code Page') }}">
          <i class="icon-scan-qr-code"></i>
        </a>
      </li>
      <li class="{{ request()->is('topup/history') ? 'active' : '' }}">
        <a class="fw_4 d-flex justify-content-center align-items-center flex-column" href="{{ route('Topup History Page') }}">
          <i class="bx bx-history {{ request()->is('topup/history') ? 'text-primary' : 'text-muted' }}" style="font-size: 24px;"></i>
          Transfer
        </a>
      </li>
      <li class="{{ request()->is('profile') ? 'active' : '' }}">
        <a class="fw_4 d-flex justify-content-center align-items-center flex-column" href="{{ route('Profile Page') }}">
          <i class="icon-user-outline"></i> Profile
        </a>
      </li>
    </ul>
  </div>
</div>