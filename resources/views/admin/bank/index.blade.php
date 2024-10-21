@extends('admin.layouts.index')
@section('title-bar', 'Setelan Pembayaran')
@section('title', 'Setelan Pembayaran')
@section('content')

<div class="modal fade" id="bankModal" tabindex="-1" aria-labelledby="bankModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="bankModalLabel">Tambah/Edit Bank</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="bankForm" method="POST" action="{{ route('admin.bank.store') }}">
        @csrf
        <div class="modal-body">
          <input type="hidden" name="id" id="bankId">
          <div class="mb-3">
            <label for="bankCode" class="form-label">Bank</label>
            <select name="bankCode" id="bankCode" class="form-select">
              @foreach ($banks as $key => $bank)
              <option value="{{ $key }}">{{$key . ' - ' . $bank }}</option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label for="accountNumber" class="form-label">Nomor Rekening</label>
            <input type="text" class="form-control" id="accountNumber" name="account_number" required>
          </div>
          <div class="mb-3">
            <label for="accountName" class="form-label">Nama Akun Bank</label>
            <input type="text" class="form-control" id="accountName" name="account_name" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary" id="saveBankBtn">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="card">
  <div class="d-flex card-header justify-content-between align-items-center">
    <div>
      <h4 class="card-title">Daftar Bank</h4>
    </div>
    <div>
      <a href="javascript:void(0)" class="btn btn-primary d-flex align-items-center gap-2" data-bs-toggle="modal"
        data-bs-target="#bankModal" onclick="add()">
        <i class="bx bx-plus-circle fs-20"></i>
        Tambah Bank
      </a>
    </div>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-hover table-striped" id="table-bank">
        <thead>
          <tr>
            <th class="text-center">
              Kode Bank
            </th>
            <th>
              Nama Bank
            </th>
            <th class="text-start">
              Nomor Rekening
            </th>
            <th>
              Nama Akun Bank
            </th>
            <th>
              Aksi
            </th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
</div>
@endsection
@push('script')
<script>
  $(document).ready(function() {
    $('#table-bank').dataTable({
      language: {
        url: "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Indonesian.json"
      },
      ajax: {
        url: '{{ route('admin.bank.data') }}',
        type: 'GET',
      },
      columns: [
        { data: 'bank_account_number', className: 'text-center' },
        { data: 'bank_name' },
        { data: 'rekening', className: 'text-start' },
        { data: 'bank_account_name' },
        { data: 'action', orderable: false, searchable: false, className: 'text-center' },
      ],
    });
  });

  function destroy(id) {
    Swal.fire({
      title: 'Apakah anda yakin?',
      text: "Bank akan dihapus secara permanen",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya, hapus!',
      cancelButtonText: 'Batal',
    }).then((result) => {
    $.ajax({
      url: "/admin/bank/delete/"+id,
      type: "GET",
      data: {
        _token: "{{ csrf_token() }}",
      },
      success: function(response) {
        $('#table-bank').DataTable().ajax.reload();
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

 var choices = new Choices('#bankCode', {
    searchEnabled: true,
    allowHTML: true,
  })

  function edit(data) {
    $('#bankModal').modal('show');
    $('#bankId').val(data.id);
    $('#bankCode').val(data.bank_code);
    $('#accountNumber').val(data.rekening);
    $('#accountName').val(data.bank_account_name);
    choices.setChoiceByValue(data.bank_account_number);
  }

  function add() {
    $('#bankModal').modal('show');
    $('#bankId').val('');
    $('#bankCode').val('');
    $('#accountNumber').val('');
    $('#accountName').val('');
    choices.setChoiceByValue('');
  }
</script>
@endpush