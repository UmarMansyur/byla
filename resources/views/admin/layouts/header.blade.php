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
            <span class="position-absolute topbar-badge fs-10 translate-middle badge bg-danger rounded-pill">3<span
                class="visually-hidden">unread messages</span></span>
          </button>
          <div class="dropdown-menu py-0 dropdown-lg dropdown-menu-end"
            aria-labelledby="page-header-notifications-dropdown">
            <div class="p-3 border-top-0 border-start-0 border-end-0 border-dashed border">
              <div class="row align-items-center">
                <div class="col">
                  <h6 class="m-0 fs-16 fw-semibold"> Notifications</h6>
                </div>
                <div class="col-auto">
                  <a href="javascript: void(0);" class="text-dark text-decoration-underline">
                    <small>Clear All</small>
                  </a>
                </div>
              </div>
            </div>
            <div data-simplebar="init" style="max-height: 280px;">
              <div class="simplebar-wrapper" style="margin: 0px;">
                <div class="simplebar-height-auto-observer-wrapper">
                  <div class="simplebar-height-auto-observer"></div>
                </div>
                <div class="simplebar-mask">
                  <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                    <div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content"
                      style="height: auto; overflow: hidden;">
                      <div class="simplebar-content" style="padding: 0px;">
                        <!-- Item -->
                        <a href="javascript:void(0);" class="dropdown-item py-3 border-bottom text-wrap">
                          <div class="d-flex">
                            <div class="flex-shrink-0">
                              <img src="/admin/images/users/avatar-1.jpg"
                                class="img-fluid me-2 avatar-sm rounded-circle" alt="avatar-1">
                            </div>
                            <div class="flex-grow-1">
                              <p class="mb-0"><span class="fw-medium">Josephine Thompson </span>commented on admin
                                panel <span>" Wow 😍! this admin looks good and awesome design"</span></p>
                            </div>
                          </div>
                        </a>
                        <!-- Item -->
                        <a href="javascript:void(0);" class="dropdown-item py-3 border-bottom">
                          <div class="d-flex">
                            <div class="flex-shrink-0">
                              <div class="avatar-sm me-2">
                                <span class="avatar-title bg-soft-info text-info fs-20 rounded-circle">
                                  D
                                </span>
                              </div>
                            </div>
                            <div class="flex-grow-1">
                              <p class="mb-0 fw-semibold">Donoghue Susan</p>
                              <p class="mb-0 text-wrap">
                                Hi, How are you? What about our next meeting
                              </p>
                            </div>
                          </div>
                        </a>
                        <!-- Item -->
                        <a href="javascript:void(0);" class="dropdown-item py-3 border-bottom">
                          <div class="d-flex">
                            <div class="flex-shrink-0">
                              <img src="/admin/images/users/avatar-3.jpg"
                                class="img-fluid me-2 avatar-sm rounded-circle" alt="avatar-3">
                            </div>
                            <div class="flex-grow-1">
                              <p class="mb-0 fw-semibold">Jacob Gines</p>
                              <p class="mb-0 text-wrap">Answered to your comment on the cash flow forecast's graph
                                🔔.</p>
                            </div>
                          </div>
                        </a>
                        <!-- Item -->
                        <a href="javascript:void(0);" class="dropdown-item py-3 border-bottom">
                          <div class="d-flex">
                            <div class="flex-shrink-0">
                              <div class="avatar-sm me-2">
                                <span class="avatar-title bg-soft-warning text-warning fs-20 rounded-circle">
                                  <iconify-icon icon="iconamoon:comment-dots-duotone"></iconify-icon>
                                </span>
                              </div>
                            </div>
                            <div class="flex-grow-1">
                              <p class="mb-0 fw-semibold text-wrap">You have received <b>20</b> new messages in the
                                conversation</p>
                            </div>
                          </div>
                        </a>
                        <!-- Item -->
                        <a href="javascript:void(0);" class="dropdown-item py-3 border-bottom">
                          <div class="d-flex">
                            <div class="flex-shrink-0">
                              <img src="/admin/images/users/avatar-5.jpg"
                                class="img-fluid me-2 avatar-sm rounded-circle" alt="avatar-5">
                            </div>
                            <div class="flex-grow-1">
                              <p class="mb-0 fw-semibold">Shawn Bunch</p>
                              <p class="mb-0 text-wrap">
                                Commented on Admin
                              </p>
                            </div>
                          </div>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="simplebar-placeholder" style="width: 0px; height: 0px;"></div>
              </div>
              <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
              </div>
              <div class="simplebar-track simplebar-vertical" style="visibility: hidden;">
                <div class="simplebar-scrollbar" style="height: 0px; display: none;"></div>
              </div>
            </div>
            <div class="text-center py-3">
              <a href="javascript:void(0);" class="btn btn-primary btn-sm">View All Notification <i
                  class="bx bx-right-arrow-alt ms-1"></i></a>
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
            <a class="dropdown-item" href="pages-profile.html">
              <i class="bx bx-user-circle text-muted fs-18 align-middle me-1"></i><span
                class="align-middle">Profile</span>
            </a>

            <div class="dropdown-divider my-1"></div>

            <a class="dropdown-item text-danger" href="auth-signin.html">
              <i class="bx bx-log-out fs-18 align-middle me-1"></i><span class="align-middle">Logout</span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>