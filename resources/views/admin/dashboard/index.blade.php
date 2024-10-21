@extends('admin.layouts.index')

@section('title', 'Dashboard')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="alert alert-primary text-truncate mb-3" role="alert">
      Berikut adalah ringkasan data dari sistem kami.
    </div>
    <div class="row">
      <div class="col-md-6 mb-2">
        <div class="card overflow-hidden">
          <div class="card-body">
            <div class="row">
              <div class="col-6">
                <div class="avatar-md bg-soft-primary rounded">
                  <iconify-icon icon="solar:users-group-rounded-broken" class="avatar-title fs-32 text-primary">
                  </iconify-icon>
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
      <div class="col-md-6 mb-2">
        <div class="card overflow-hidden">
          <div class="card-body">
            <div class="row">
              <div class="col-6">
                <div class="avatar-md bg-soft-primary rounded">
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
                <span class="text-success"> <i class="bx bxs-up-arrow fs-12"></i> {{ $total_merchants_percentage
                  }}%</span>
                @else
                <span class="text-danger"> <i class="bx bxs-down-arrow fs-12"></i> {{ $total_merchants_percentage
                  }}%</span>
                @endif
                <span class="text-muted ms-1 fs-12">Bulan lalu</span>
              </div>
              <a href="#!" class="text-reset fw-semibold fs-12">View More</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6 mb-2">
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
                <span class="text-success"> <i class="bx bxs-up-arrow fs-12"></i> {{ $total_transactions_percentage
                  }}%</span>
                @else
                <span class="text-danger"> <i class="bx bxs-down-arrow fs-12"></i> {{ $total_transactions_percentage
                  }}%</span>
                @endif
                <span class="text-muted ms-1 fs-12">Bulan lalu</span>
              </div>
              <a href="#!" class="text-reset fw-semibold fs-12">View More</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6 mb-2">
        <div class="card overflow-hidden">
          <div class="card-body">
            <div class="row">
              <div class="col-6">
                <div class="avatar-md bg-soft-primary rounded">
                  <iconify-icon icon="solar:wad-of-money-outline" class="avatar-title fs-32 text-primary">
                  </iconify-icon>
                </div>
              </div>
              <div class="col-6 text-end">
                <p class="text-muted mb-0 text-truncate">Total Transaksi</p>
                <h3 class="text-dark mt-1 mb-0">
                  Rp. {{ number_format($total_revenue, 0, ',', '.') }}
                </h3>
              </div>
            </div>
          </div>
          <div class="card-footer py-2 bg-light bg-opacity-50">
            <div class="d-flex align-items-center justify-content-between">
              <div>
                @if ($total_revenue_percentage > 0)
                <span class="text-success"> <i class="bx bxs-up-arrow fs-12"></i> {{ $total_revenue_percentage
                  }}%</span>
                @else
                <span class="text-danger"> <i class="bx bxs-down-arrow fs-12"></i> {{ $total_revenue_percentage
                  }}%</span>
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
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <h4>Grafik Transaksi</h4>
        <div id="chart"></div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-body">
        <div class="d-flex align-items-center justify-content-between">
          <h4 class="card-title">
            Riwayat Transaksi
          </h4>
          <a href="/admin/transaction" class="btn btn-sm btn-soft-primary">
            <i class="bx bx-plus me-1"></i>Lihat Semua
          </a>
        </div>
      </div>
      <!-- end card body -->
      <div class="table-responsive table-centered">
        <table class="table mb-0">
          <thead class="bg-light bg-opacity-50">
            <tr>
              <th class="ps-3">
                Kode Transaksi
              </th>
              <th>
                Tanggal Transaksi
              </th>
              <th>
                Pengguna
              </th>
              <th>
                Merchant
              </th>
              <th>
                Nominal
              </th>
              <th>
                Status
              </th>
            </tr>
          </thead>
          <tbody>
            {{-- @foreach ($history_transaction as $transaction)
            <tr>
              <td class="ps-3">
                <a href="order-detail.html">#RB5625</a>
              </td>
              <td>29 April 2024</td>
              <td>
                <div class="d-flex align-items-center gap-2">
                  <div class="avatar-sm border rounded-circle overflow-hidden">
                    <img src="{{ Auth::guard('admin')->user()->thumbnail }}" alt="product-1(1)" class="img-fluid avatar-sm">
                  </div>
                  <div>
                    <h5 class="fs-14 my-0 fw-semibold">
                      {{ $history_transaction->user->name }}
                    </h5>
                  </div>
                </div>
              </td>
              <td>
                <a href="#!">
                  {{ $history_transaction->merchant->name }}
                </a>
              </td>
              <td>
                Rp. {{ number_format($history_transaction->nominal, 0, ',', '.') }}
              </td>
              <td>
                <span class="badge bg-{{ $history_transaction->status == 'success' ? 'success' : ($history_transaction->status == 'pending' ? 'warning' : 'danger') }}">
                  {{ $history_transaction->status }}
                </span>
              </td>
            </tr>
            @endforeach --}}
            @if($history_transaction->isEmpty())
            <tr>
              <td colspan="7" class="text-center">
                Tidak ada data transaksi.
              </td>
            </tr>
            @endif
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
@push('script')
<script>
  const datas = @json($data_transaction_chart);
  const options = {
    series: [{
      name: 'Transaksi',
      data: datas.map(item => item.nominal)
    }],
    chart: {
      type: 'bar',
      height: 313
    },
    colors: ["#ff6c2f"],
    plotOptions: {
      bar: {
        columnWidth: '60%',
        distributed: true
      }
    },
    fill: {
        gradient: {
            enabled: true,
            shade: 'dark',
            shadeIntensity: 0.2,
            inverseColors: false,
            opacityFrom: 1,
            opacityTo: 1,
            stops: [0, 50, 65, 91]
        },
    },
    legend: {
      show: false
    },
    stroke: {
        dashArray: 4
    },
    dataLabels: {
      enabled: false
    },
    xaxis: {
      categories: ['Jan', 'Feb', 'Maret', 'Apr', 'Mei', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
      labels: {
        style: {
          fontSize: '12px'
        }
      }
    },
    yaxis: {
      title: {
        text: 'Nominal Transaksi'  // beri judul sumbu Y
      }
    },
    tooltip: {
      y: {
        formatter: function(val) {
          return "Rp " + val.toLocaleString();  // format tooltip dengan rupiah
        }
      }
    }
  };
  const chart = new ApexCharts(document.querySelector("#chart"), options);
  chart.render();
</script>
@endpush