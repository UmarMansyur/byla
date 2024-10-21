@extends('admin.layouts.index')
@section('title', 'Laporan Transfer/Top Up')
@section('title-bar', 'Laporan Transfer/Top Up')
@section('content')
<div class="row">
  <div class="col-md-6 col-xl-4">
    <div class="card">
      <div class="card-body">
        <div class="d-flex align-items-center gap-2 mb-3">
          <div class="avatar-md bg-primary bg-opacity-10 rounded">
            <i class="bx bx-shield-quarter fs-32 text-primary avatar-title"></i>
          </div>
          <div>
            <h4 class="mb-0">Semua Transaksi</h4>
          </div>
        </div>
        <div class="d-flex align-items-center justify-content-between">
          <p class="text-muted fw-medium fs-22 mb-0">
            {{ $jumlah_transaksi }}
          </p>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-xl-4">
    <div class="card">
      <div class="card-body">
        <div class="d-flex align-items-center gap-2 mb-3">
          <div class="avatar-md bg-primary bg-opacity-10 rounded">
            <i class="bx bx-check-shield fs-32 text-primary avatar-title"></i>
          </div>
          <div>
            <h4 class="mb-0">Transaksi Berhasil</h4>
          </div>
        </div>
        <div class="d-flex align-items-center justify-content-between">
          <p class="text-muted fw-medium fs-22 mb-0">
            {{ $jumlah_transaksi_success }}
          </p>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-xl-4">
    <div class="card">
      <div class="card-body">
        <div class="d-flex align-items-center gap-2 mb-3">
          <div class="avatar-md bg-primary bg-opacity-10 rounded">
            <i class="bx bx-shield-x fs-32 text-primary avatar-title"></i>
          </div>
          <div>
            <h4 class="mb-0">Transaksi Ditolak</h4>
          </div>
        </div>
        <div class="d-flex align-items-center justify-content-between">
          <p class="text-muted fw-medium fs-22 mb-0">
            {{ $jumlah_transaksi_failed }}
          </p>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-xl-12">
    <div class="card">
      <div class="d-flex card-header justify-content-between align-items-center">
        <div>
          <h4 class="card-title">Semua Transaksi</h4>
        </div>
      </div>
      <div>
        <div class="table-responsive">
          <table class="table align-middle mb-0 table-hover table-centered table-borderless" id="table-merchant">
            <thead class="bg-light-subtle">
              <tr>
                <th>Pengguna</th>
                <th>Kode Transaksi</th>
                <th>Jenis Transaksi</th>
                <th>Jumlah</th>
                <th>Tanggal</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('script')
<script>
  $(document).ready(function() {
    $('#table-merchant').dataTable({
      language: {
        url: "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Indonesian.json"
      },
      ajax: {
        url: "{{ route('admin.laporan-transfer.data') }}",
        type: "GET",
      },
      columns: [
        { 
          data: 'user',
         },
         { data: 'kode_transaksi' },
        { data: 'jenis_transaksi' },
        { data: 'jumlah', className: 'text-end' },
        { data: 'tanggal' },
        { data: 'status' },
      ],
      rowCallback: function(row, data) {
        $(row).find('td:eq(7)').addClass('text-center');
      }
    });
  });

  function destroy(id) {
    Swal.fire({
      title: 'Apakah anda yakin?',
      text: "Merchant akan dihapus secara permanen",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya, hapus!',
      cancelButtonText: 'Batal',
    }).then((result) => {
    $.ajax({
      url: "/admin/merchants/delete/"+id,
      type: "GET",
      data: {
        _token: "{{ csrf_token() }}",
      },
      success: function(response) {
        $('#table-merchant').DataTable().ajax.reload();
        Swal.fire({
          title: 'Berhasil!',
          text: "Merchant berhasil dihapus",
          icon: 'success',
          showConfirmButton: false,
          timer: 1500
          });
        }
      });
    });
  }

  function detail(id) {
    $('#id').val(id);
  }

  function updateStatus(id, status) {
    $.ajax({
      url: "{{ route('admin.merchant.update-status', ['id' => ':id']) }}".replace(':id', id),
      type: "PUT",
      data: {
        _token: "{{ csrf_token() }}",
        status: status,
      },
    });
  }
</script>
@endpush