<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>@yield('title-bar') | Larkon - Responsive Admin Dashboard Template</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="A fully responsive premium admin dashboard template" />
  <meta name="author" content="Techzaa" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <link rel="shortcut icon" href="/admin/images/only-logo.svg">
  @notifyCss  
  <link href="
https://cdn.jsdelivr.net/npm/sweetalert2@11.14.2/dist/sweetalert2.min.css
" rel="stylesheet">
  <link href="/admin/css/vendor.min.css" rel="stylesheet" type="text/css" />
  <link href="/admin/css/icons.min.css" rel="stylesheet" type="text/css" />
  <link href="/admin/css/app.min.css" rel="stylesheet" type="text/css" />
  <script src="/admin/js/config.js"></script>
  @vite('resources/js/app.js')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.54.0/apexcharts.min.css" integrity="sha512-a+TagZggv1pq6n/4xBSDjlpi8MQMsH0OAF2rlFOKifNKlAjk30uAg/EJeRBuL76Zq4dYLHa0ezegidxDgHzjMA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
  <link rel="stylesheet" href="/admin/css/datatable.min.css">
</head>

<body>
  <div class="relative" style="z-index: 10000 !important;">
    <x-notify::notify />
  </div>
  <div class="wrapper">
    @include('admin.layouts.header')
    <div>
      <div class="offcanvas offcanvas-end border-0" tabindex="-1" id="theme-activity-offcanvas"
        style="max-width: 450px; width: 100%;">
        <div class="d-flex align-items-center bg-primary p-3 offcanvas-header">
          <h5 class="text-white m-0 fw-semibold">Activity Stream</h5>
          <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="offcanvas"
            aria-label="Close"></button>
        </div>

        <div class="offcanvas-body p-0">
          <div data-simplebar="init" class="h-100 p-4">
            <div class="simplebar-wrapper" style="margin: -36px;">
              <div class="simplebar-height-auto-observer-wrapper">
                <div class="simplebar-height-auto-observer"></div>
              </div>
              <div class="simplebar-mask">
                <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                  <div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content"
                    style="height: 100%; overflow: hidden scroll;">
                    <div class="simplebar-content" style="padding: 36px;">
                      <div class="position-relative ms-2">
                        <span class="position-absolute start-0  top-0 border border-dashed h-100"></span>
                        <div class="position-relative ps-4">
                          <div class="mb-4">
                            <span
                              class="position-absolute start-0 avatar-sm translate-middle-x bg-danger d-inline-flex align-items-center justify-content-center rounded-circle text-light fs-20">
                              <iconify-icon icon="iconamoon:folder-check-duotone"></iconify-icon>
                            </span>
                            <div class="ms-2">
                              <h5 class="mb-1 text-dark fw-semibold fs-15 lh-base">Report-Fix / Update </h5>
                              <p class="d-flex align-items-center">Add 3 files to <span
                                  class=" d-flex align-items-center text-primary ms-1">
                                  <iconify-icon icon="iconamoon:file-light"></iconify-icon> Tasks
                                </span></p>
                              <div class="bg-light bg-opacity-50 rounded-2 p-2">
                                <div class="row">
                                  <div class="col-lg-6 border-end border-light">
                                    <div class="d-flex align-items-center gap-2">
                                      <i class="bx bxl-figma fs-20 text-red"></i>
                                      <a href="#!" class="text-dark fw-medium">Concept.fig</a>
                                    </div>
                                  </div>
                                  <div class="col-lg-6">
                                    <div class="d-flex align-items-center gap-2">
                                      <i class="bx bxl-file-doc fs-20 text-success"></i>
                                      <a href="#!" class="text-dark fw-medium">larkon.docs</a>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <h6 class="mt-2 text-muted">Monday , 4:24 PM</h6>
                            </div>
                          </div>
                        </div>
                        <div class="position-relative ps-4">
                          <div class="mb-4">
                            <span
                              class="position-absolute start-0 avatar-sm translate-middle-x bg-success d-inline-flex align-items-center justify-content-center rounded-circle text-light fs-20">
                              <iconify-icon icon="iconamoon:check-circle-1-duotone"></iconify-icon>
                            </span>
                            <div class="ms-2">
                              <h5 class="mb-1 text-dark fw-semibold fs-15 lh-base">Project Status
                              </h5>
                              <p class="d-flex align-items-center mb-0">Marked<span
                                  class=" d-flex align-items-center text-primary mx-1">
                                  <iconify-icon icon="iconamoon:file-light"></iconify-icon> Design
                                </span> as <span class="badge bg-success-subtle text-success px-2 py-1 ms-1">
                                  Completed</span></p>
                              <div class="d-flex align-items-center gap-3 mt-1 bg-light bg-opacity-50 p-2 rounded-2">
                                <a href="#!" class="fw-medium text-dark">UI/UX Figma Design</a>
                                <div class="ms-auto">
                                  <a href="#!" class="fw-medium text-primary fs-18" data-bs-toggle="tooltip"
                                    data-bs-title="Download" data-bs-placement="bottom">
                                    <iconify-icon icon="iconamoon:cloud-download-duotone"></iconify-icon>
                                  </a>
                                </div>
                              </div>
                              <h6 class="mt-3 text-muted">Monday , 3:00 PM</h6>
                            </div>
                          </div>
                        </div>
                        <div class="position-relative ps-4">
                          <div class="mb-4">
                            <span
                              class="position-absolute start-0 avatar-sm translate-middle-x bg-primary d-inline-flex align-items-center justify-content-center rounded-circle text-light fs-16">UI</span>
                            <div class="ms-2">
                              <h5 class="mb-1 text-dark fw-semibold fs-15">Larkon Application UI v2.0.0 <span
                                  class="badge bg-primary-subtle text-primary px-2 py-1 ms-1"> Latest</span>
                              </h5>
                              <p>Get access to over 20+ pages including a dashboard layout, charts, kanban board,
                                calendar, and pre-order E-commerce &amp; Marketing pages.</p>
                              <div class="mt-2">
                                <a href="#!" class="btn btn-light btn-sm">Download Zip</a>
                              </div>
                              <h6 class="mt-3 text-muted">Monday , 2:10 PM</h6>
                            </div>
                          </div>
                        </div>
                        <div class="position-relative ps-4">
                          <div class="mb-4">
                            <span
                              class="position-absolute start-0 translate-middle-x bg-success bg-gradient d-inline-flex align-items-center justify-content-center rounded-circle text-light fs-20"><img
                                src="/admin/images/users/avatar-7.jpg" alt="avatar-5"
                                class="avatar-sm rounded-circle"></span>
                            <div class="ms-2">
                              <h5 class="mb-0 text-dark fw-semibold fs-15 lh-base">Alex Smith Attached Photos
                              </h5>
                              <div class="row g-2 mt-2">
                                <div class="col-lg-4">
                                  <a href="#!">
                                    <img src="/admin/images/small/img-6.jpg" alt="" class="img-fluid rounded">
                                  </a>
                                </div>
                                <div class="col-lg-4">
                                  <a href="#!">
                                    <img src="/admin/images/small/img-3.jpg" alt="" class="img-fluid rounded">
                                  </a>
                                </div>
                                <div class="col-lg-4">
                                  <a href="#!">
                                    <img src="/admin/images/small/img-4.jpg" alt="" class="img-fluid rounded">
                                  </a>
                                </div>
                              </div>
                              <h6 class="mt-3 text-muted">Monday 1:00 PM</h6>
                            </div>
                          </div>
                        </div>
                        <div class="position-relative ps-4">
                          <div class="mb-4">
                            <span
                              class="position-absolute start-0 translate-middle-x bg-success bg-gradient d-inline-flex align-items-center justify-content-center rounded-circle text-light fs-20"><img
                                src="/admin/images/users/avatar-6.jpg" alt="avatar-5"
                                class="avatar-sm rounded-circle"></span>
                            <div class="ms-2">
                              <h5 class="mb-0 text-dark fw-semibold fs-15 lh-base">Rebecca J. added a new team member
                              </h5>
                              <p class="d-flex align-items-center gap-1">
                                <iconify-icon icon="iconamoon:check-circle-1-duotone" class="text-success">
                                </iconify-icon> Added a new member to Front Dashboard
                              </p>
                              <h6 class="mt-3 text-muted">Monday 10:00 AM</h6>
                            </div>
                          </div>
                        </div>
                        <div class="position-relative ps-4">
                          <div class="mb-4">
                            <span
                              class="position-absolute start-0 avatar-sm translate-middle-x bg-warning d-inline-flex align-items-center justify-content-center rounded-circle text-light fs-20">
                              <iconify-icon icon="iconamoon:certificate-badge-duotone"></iconify-icon>
                            </span>
                            <div class="ms-2">
                              <h5 class="mb-0 text-dark fw-semibold fs-15 lh-base">Achievements
                              </h5>
                              <p class="d-flex align-items-center gap-1 mt-1">Earned a <iconify-icon
                                  icon="iconamoon:certificate-badge-duotone" class="text-danger fs-20"></iconify-icon>"
                                Best Product Award"</p>
                              <h6 class="mt-3 text-muted">Monday 9:30 AM</h6>
                            </div>
                          </div>
                        </div>
                      </div>
                      <a href="#!" class="btn btn-outline-dark w-100">View All</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="simplebar-placeholder" style="width: auto; height: 1102px;"></div>
            </div>
            <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
              <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
            </div>
            <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
              <div class="simplebar-scrollbar"
                style="height: 126px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="main-nav">
      <div class="logo-box">
        <a href="index.html" class="logo-dark">
          <img src="/admin/only-logo.svg" class="logo-sm" alt="logo sm">
          <img src="/admin/logo.svg" class="logo-lg" alt="logo dark">
        </a>
        <a href="index.html" class="logo-light">
          <img src="/admin/only-logo.svg" class="logo-sm" alt="logo sm">
          <img src="/admin/logo.svg" class="logo-lg" alt="logo light">
        </a>
      </div>
      <button type="button" class="button-sm-hover" aria-label="Show Full Sidebar">
        <iconify-icon icon="solar:double-alt-arrow-right-bold-duotone" class="button-sm-hover-icon"></iconify-icon>
      </button>
      @include('admin.layouts.sidebar')
    </div>
    <div class="page-content">
      <div class="container-fluid">
        @yield('content')
      </div>
      <footer class="footer">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12 text-center">2024 © Byla. Crafted by <iconify-icon icon="iconamoon:heart-duotone"
                class="fs-18 align-middle text-danger"></iconify-icon> <a href="https://github.com/UmarMansyur"
                class="fw-bold footer-text" target="_blank">ProJs Universitas Madura</a>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>
  @notifyJs
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
  <script src="/admin/js/vendor.js"></script>
  <script src="/admin/js/app.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.54.0/apexcharts.min.js" integrity="sha512-fsEkf13FMKFZJA3KF4dm/lzU8si2ZXSXwc35yjU+kP0VJiLkbmIBpqIq+4EWcoOO12+UZ1klbynmnjMqFADqUQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  @stack('script')
</body>
</html>