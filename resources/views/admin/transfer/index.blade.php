@extends('admin.layouts.index')
@section('title', 'Transfer')
@section('title-bar', 'Transfer')
@section('content')

<div class="row">
  <div class="col-xl-12">
    {{-- buat modal untuk alasan ditolak --}}
    <div class="modal fade" id="modal-alasan-ditolak" tabindex="-1" aria-labelledby="modal-alasan-ditolak-label"
      aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modal-alasan-ditolak-label">Alasan Ditolak</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form method="POST" action="{{ route('admin.transfer.ditolak') }}" id="form-alasan-ditolak">
              @csrf
              @method('POST')
              <div class="mb-3">
                <input type="hidden" name="id" id="id">
                <label for="alasan" class="form-label">Alasan Ditolak</label>
                <textarea type="text" class="form-control" id="alasan" required placeholder="Masukkan alasan ditolak"
                  name="alasan" rows="5"></textarea>
              </div>
              <div class="d-flex align-items-center gap-2 justify-content-between">
                <button type="submit" class="btn btn-primary">
                  <i class="bx bx-send"></i>
                  Kirim
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
          <h4 class="card-title">Semua Transfer</h4>
        </div>
      </div>
      <div>
        <div class="table-responsive">
          <table class="table align-middle mb-0 table-hover table-centered table-borderless" id="table-pengguna">
            <thead class="bg-light-subtle">
              <tr>
                <th>Pengguna</th>
                <th>Kode Transfer</th>
                <th>Jumlah Transfer</th>
                <th>Rekening Tujuan</th>
                <th>Nama Pemilik Rekening</th>
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
        url: "{{ route('Transfer Get Data JSON') }}",
        type: "GET",
      },
      columns: [
        { 
          data: 'pengguna',
         },
         { data: 'kode_transaksi' },
         { data: 'kredit' },
         { data: 'rekening' },
         { data: 'nama' },
         { data: 'status' },
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
      text: "Transfer akan dihapus secara permanen",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya, hapus!',
      cancelButtonText: 'Batal',
    }).then((result) => {
    $.ajax({
      url: "/admin/delete/transfer/"+id,
      type: "GET",
      data: {
        _token: "{{ csrf_token() }}",
      },
      success: function(response) {
        $('#table-transfer').DataTable().ajax.reload();
        Swal.fire({
          title: 'Berhasil!',
          text: "Transfer berhasil dihapus",
          icon: 'success',
          showConfirmButton: false,
          timer: 1500
        });
      }
    });
    });
  }

  function tolak_penarikan(id) {
    $('#id').val(id);
    $('#modal-alasan-ditolak').modal('show');
  }

  function setujui_penarikan(id) {
    $('#id').val(id);
    Swal.fire({
      title: 'Apakah anda yakin?',
      text: "Transfer akan disetujui",
      icon: 'warning', 
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya, setujui!',
      cancelButtonText: 'Batal',
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "/admin/transfer/disetujui",
          type: "POST",
          data: {
            id: id,
            _token: "{{ csrf_token() }}",
          },
          success: function(response) {
            $('#table-transfer').DataTable().ajax.reload();
            Swal.fire({
              title: 'Berhasil!',
              text: "Transfer berhasil disetujui",
              icon: 'success',
            });
          }
        });
      }
    });
  }

  // subscribe ke channel transaksi-update
  Pusher.subscribe('transaksi-update');
</script>
@endpush