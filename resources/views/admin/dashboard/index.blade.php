@extends('admin.layouts.index')

@section('title', 'Dashboard')

@section('content')
<div class="row">
  <div class="col-md-6">
    <div class="row">
      <div class="col-md-6 mb-3">
        <div class="card overflow-hidden">
          <div class="card-body">
            <div class="row">
              <div class="col-6">
                <div class="avatar-md bg-soft-primary rounded">
                  <iconify-icon icon="solar:users-group-rounded-broken" class="avatar-title fs-32 text-primary"></iconify-icon>
                </div>
              </div>
              <div class="col-6 text-end">
                <p class="text-muted mb-0 text-truncate">Total Pengguna</p>
                <h3 class="text-dark mt-1 mb-0">
                  {{ $total_users }}
                </h3>
              </div>
            </div>
          </div>
          <div class="card-footer py-2 bg-light bg-opacity-50">
            <div class="d-flex align-items-center justify-content-between">
              <div>
                @if ($total_users_percentage > 0)
                  <span class="text-success"> <i class="bx bxs-up-arrow fs-12"></i> {{ $total_users_percentage }}%</span>
                @else
                  <span class="text-danger"> <i class="bx bxs-down-arrow fs-12"></i> {{ $total_users_percentage }}%</span>
                @endif
                <span class="text-muted ms-1 fs-12">Bulan lalu</span>
              </div>
              <a href="#!" class="text-reset fw-semibold fs-12">View More</a>
            </div>
          </div> <!-- end card body -->
        </div> <!-- end card -->
      </div>
      <div class="col-md-6 mb-3">
        <div class="card overflow-hidden">
          <div class="card-body">
            <div class="row">
              <div class="col-6">
                <div class="avatar-md bg-soft-primary rounded">
                  {{-- <iconify-icon icon="solar:users-group-rounded-broken" class="avatar-title fs-32 text-primary"></iconify-icon> --}}
                  <i class="bx bx-store-alt fs-32 text-primary avatar-title"></i>
                </div>
              </div>
              <div class="col-6 text-end">
                <p class="text-muted mb-0 text-truncate">Total Merchant</p>
                <h3 class="text-dark mt-1 mb-0">
                  {{ $total_merchants }}
                </h3>
              </div>
            </div>
          </div>
          <div class="card-footer py-2 bg-light bg-opacity-50">
            <div class="d-flex align-items-center justify-content-between">
              <div>
                @if ($total_merchants_percentage > 0)
                  <span class="text-success"> <i class="bx bxs-up-arrow fs-12"></i> {{ $total_merchants_percentage }}%</span>
                @else
                  <span class="text-danger"> <i class="bx bxs-down-arrow fs-12"></i> {{ $total_merchants_percentage }}%</span>
                @endif
                <span class="text-muted ms-1 fs-12">Bulan lalu</span>
              </div>
              <a href="#!" class="text-reset fw-semibold fs-12">View More</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6 mb-3">
        <div class="card overflow-hidden">
          <div class="card-body">
            <div class="row">
              <div class="col-6">
                <div class="avatar-md bg-soft-primary rounded">
                  <iconify-icon icon="solar:wallet-bold-duotone" class="avatar-title fs-32 text-primary"></iconify-icon>
                </div>
              </div>
              <div class="col-6 text-end">
                <p class="text-muted mb-0 text-truncate">Jumlah Transaksi</p>
                <h3 class="text-dark mt-1 mb-0">
                  {{ $total_transactions }}
                </h3>
              </div>
            </div>
          </div>
          <div class="card-footer py-2 bg-light bg-opacity-50">
            <div class="d-flex align-items-center justify-content-between">
              <div>
                @if ($total_transactions_percentage > 0)
                  <span class="text-success"> <i class="bx bxs-up-arrow fs-12"></i> {{ $total_transactions_percentage }}%</span>
                @else
                  <span class="text-danger"> <i class="bx bxs-down-arrow fs-12"></i> {{ $total_transactions_percentage }}%</span>
                @endif
                <span class="text-muted ms-1 fs-12">Bulan lalu</span>
              </div>
              <a href="#!" class="text-reset fw-semibold fs-12">View More</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6 mb-3">
        <div class="card overflow-hidden">
          <div class="card-body">
            <div class="row">
              <div class="col-6">
                <div class="avatar-md bg-soft-primary rounded">
                  <iconify-icon icon="solar:wad-of-money-outline" class="avatar-title fs-32 text-primary"></iconify-icon>
                </div>
              </div>
              <div class="col-6 text-end">
                <p class="text-muted mb-0 text-truncate">Total Transaksi</p>
                <h3 class="text-dark mt-1 mb-0">
                  {{ $total_revenue }}
                </h3>
              </div>
            </div>
          </div>
          <div class="card-footer py-2 bg-light bg-opacity-50">
            <div class="d-flex align-items-center justify-content-between">
              <div>
                @if ($total_revenue_percentage > 0)
                  <span class="text-success"> <i class="bx bxs-up-arrow fs-12"></i> {{ $total_revenue_percentage }}%</span>
                @else
                  <span class="text-danger"> <i class="bx bxs-down-arrow fs-12"></i> {{ $total_revenue_percentage }}%</span>
                @endif
                <span class="text-muted ms-1 fs-12">Bulan lalu</span>
              </div>
              <a href="#!" class="text-reset fw-semibold fs-12">View More</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection