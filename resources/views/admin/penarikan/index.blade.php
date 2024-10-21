@extends('admin.layouts.index')
@section('title', 'Pengguna')
@section('title-bar', 'Pengguna')
@section('content')
<div class="row">
  <div class="col-md-6 col-xl-4">
    <div class="card">
      <div class="card-body">
        <div class="d-flex align-items-center gap-2 mb-3">
          <div class="avatar-md bg-primary bg-opacity-10 rounded">
            <iconify-icon icon="solar:users-group-two-rounded-bold-duotone" class="fs-32 text-primary avatar-title">
            </iconify-icon>
          </div>
          <div>
            <h4 class="mb-0">Semua Pengguna</h4>
          </div>
        </div>
        <div class="d-flex align-items-center justify-content-between">
          <p class="text-muted fw-medium fs-22 mb-0">
            {{ $total_user }}
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
            <iconify-icon icon="solar:women-outline" class="fs-32 text-primary avatar-title">
            </iconify-icon>
          </div>
          <div>
            <h4 class="mb-0">Pengguna Perempuan</h4>
          </div>
        </div>
        <div class="d-flex align-items-center justify-content-between">
          <p class="text-muted fw-medium fs-22 mb-0">
            {{ $total_pengguna_perempuan }}
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
            <iconify-icon icon="solar:user-check-broken" class="fs-32 text-primary avatar-title">
            </iconify-icon>
          </div>
          <div>
            <h4 class="mb-0">Pengguna Laki-laki</h4>
          </div>
        </div>
        <div class="d-flex align-items-center justify-content-between">
          <p class="text-muted fw-medium fs-22 mb-0">
            {{ $total_pengguna_laki }}
          </p>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-xl-12">
    {{-- buat modal untuk ganti password --}}
    <div class="modal fade" id="modal-ganti-password" tabindex="-1" aria-labelledby="modal-ganti-password-label" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modal-ganti-password-label">Ganti Password</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form method="POST" action="{{ route('admin.users.change-password') }}" id="form-ganti-password">
              @csrf
              @method('PUT')
              <div class="mb-3">
                <input type="hidden" name="id" id="id">
                <label for="password-baru" class="form-label">Password Baru</label>
                <input type="password" class="form-control" id="password-baru" required placeholder="Masukkan password baru" name="password">
              </div>
              <div class="mb-3">
                <label for="password-konfirmasi" class="form-label">Konfirmasi Password</label>
                <input type="password" class="form-control" id="password-konfirmasi" required placeholder="Masukkan konfirmasi password" name="password_confirmation">
              </div>
              <div class="d-flex align-items-center gap-2 justify-content-between">
                <button type="submit" class="btn btn-primary">
                  <i class="bx bx-key"></i>
                  Ganti Password
                </button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                  <i class="bx bx-x"></i>
                  Batal
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    {{-- buat modal untuk ganti password --}}
    <div class="card">
      <div class="d-flex card-header justify-content-between align-items-center">
        <div>
          <h4 class="card-title">Semua Pengguna</h4>
        </div>
        <div>
          <a href="{{ route('admin.users.add') }}" class="btn btn-primary d-flex align-items-center gap-2">
            <iconify-icon icon="solar:user-plus-bold-duotone" class="fs-20"></iconify-icon>
            Tambah Pengguna
          </a>
        </div>
      </div>
      <div>
        <div class="table-responsive">
          <table class="table align-middle mb-0 table-hover table-centered table-borderless" id="table-pengguna">
            <thead class="bg-light-subtle">
              <tr>
                <th>Kode Pengguna</th>
                <th>Thumbnail</th>
                <th>Nama Pengguna</th>
                <th>Email</th>
                <th>No. Telpon</th>
                <th>Jenis Kelamin</th>
                <th>Status</th>
                <th>Aksi</th>
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
    $('#table-pengguna').dataTable({
      language: {
        url: "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Indonesian.json"
      },
      ajax: {
        url: "{{ route('admin.users.data') }}",
        type: "GET",
      },
      columns: [
        { 
          data: 'user_code',
          render: function(data, type, row) {
            return `<span class="badge bg-primary">${data}</span>`;
          }

         },
         { data: 'thumbnail' },
        { data: 'name' },
        { data: 'email' },
        { data: 'phone' },
        { data: 'gender' },
        { data: 'is_active' },
        { data: 'action', orderable: false, searchable: false, className: 'text-center' },
      ],
      rowCallback: function(row, data) {
        $(row).find('td:eq(7)').addClass('text-center');
      }
    });
  });
  $(document).on('click', '.dt-paging-button', function() {
    $(this).addClass('current').siblings().removeClass('current');
  });

  function destroy(id) {
    Swal.fire({
      title: 'Apakah anda yakin?',
      text: "Pengguna akan dihapus secara permanen",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya, hapus!',
      cancelButtonText: 'Batal',
    }).then((result) => {
    $.ajax({
      url: "/admin/delete/users/"+id,
      type: "GET",
      data: {
        _token: "{{ csrf_token() }}",
      },
      success: function(response) {
        $('#table-pengguna').DataTable().ajax.reload();
        Swal.fire({
          title: 'Berhasil!',
          text: "Pengguna berhasil dihapus",
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
</script>
@endpush