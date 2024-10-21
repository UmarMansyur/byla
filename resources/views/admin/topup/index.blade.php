@extends('admin.layouts.index')
@section('title', 'Transfer/Top Up')
@section('title-bar', 'Transfer/Top Up')
@section('content')

<div class="row">
  <div class="col-xl-12">
    <div class="card">
      <div class="d-flex card-header justify-content-between align-items-center">
        <div>
          <h4 class="card-title">Semua Transaksi Top Up</h4>
        </div>
      </div>
      <div>
        <div class="table-responsive">
          <table class="table align-middle mb-0 table-hover table-centered table-borderless" id="table-transfer">
            <thead class="bg-light-subtle">
              <tr>
                <th>Kode Transfer</th>
                <th>Rekening Pengirim</th>
                <th>Kredit</th>
                <th>Debit</th>
                <th>Saldo</th>
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
<div class="modal fade" id="status-view" tabindex="-1" aria-labelledby="status-view" aria-modal="true" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="status-view">Detail Top Up</h5>
        <input type="hidden" id="topupId" value="">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="modal-bukti"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" onclick="tolakTopup()">Tolak</button>
        <button type="button" class="btn btn-success" onclick="setujuiTopup()">Setujui</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="modal-alasan" tabindex="-1" aria-labelledby="modal-alasan-label" aria-modal="true"
  role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-alasan-label">Input Alasan Penolakan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label for="alasan" class="form-label">Alasan Penolakan</label>
          <textarea class="form-control" id="alasan" rows="3" placeholder="Masukkan alasan"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-danger" onclick="kirimPenolakan()">Kirim Alasan</button>
      </div>
    </div>
  </div>
</div>
@endsection

@push('script')
<script>
  $(document).ready(function() {
    $('#table-transfer').dataTable({
      language: {
        url: "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Indonesian.json"
      },
      ajax: {
        url: "{{ route('Transfer Topup Data') }}",
        type: "GET",
      },
      columns: [
        { data: 'kode_transaksi' },
        { data: 'rekening_pengirim' },
        { data: 'kredit' },
        { data: 'debit' },
        { data: 'saldo' },
        { data: 'status' },
        { data: 'action' },
      ]
    });
  });

  function view_bukti(data, id) {
    console.log(data, id);
    const elementImage = document.getElementById('modal-bukti');
    const elementId = document.getElementById('topupId');
    elementImage.innerHTML = `
      <img src="${data}" alt="bukti">
    `;
    elementId.value = id;
  }

  function tolakTopup() {
    $('#status-view').modal('hide');
    $('#modal-alasan').modal('show');
}

function kirimPenolakan() {
  let alasan = document.getElementById('alasan').value;
  let topupId = document.getElementById('topupId').value;
  if (alasan.trim() === '') {
      alert('Alasan penolakan harus diisi!');
      return;
  }
  $.ajax({
      url: '{{route('admin.topup.tolak', '')}}/' + topupId,
      method: 'POST',
      data: {
          _token: '{{ csrf_token() }}',
          alasan: alasan
      },
      success: function(response) {
          $('#modal-alasan').modal('hide');
          $('#table-transfer').DataTable().ajax.reload();
      }
  });
}

function setujuiTopup() {
  let topupId = document.getElementById('topupId').value;
  $.ajax({
      url: '{{route('admin.topup.setujui', '')}}/' + topupId,
      method: 'POST',
      data: {
          _token: '{{ csrf_token() }}'
      },
      success: function(response) {
          $('#status-view').modal('hide');
          $('#table-transfer').DataTable().ajax.reload();
      }
  });
}

window.onload = function() {
  const pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
    cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
    encrypted: true
  });

  const channel = pusher.subscribe('transaksi-update');
  channel.bind('transaksi-update', function(data) {
    $('#table-transfer').DataTable().ajax.reload();
    console.log('transaksi-update');
  });
}
</script>
@endpush