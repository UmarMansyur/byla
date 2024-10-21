@extends('pengguna.layouts.index')
@section('content')
<div class="header">
  <div class="tf-container">
    <div class="tf-statusbar d-flex justify-content-center align-items-center">
      <a href="#" class="back-btn"> <i class="icon-left"></i> </a>
      <h3>Transfer Bank</h3>
    </div>
  </div>
</div>
<div class="mt-5">
  @if (session('error'))
  <div class="alert alert-danger">
    {{ session('error') }}
  </div>
  @endif
  @if (session('success'))
  <div class="alert alert-success">
    {{ session('success') }}
  </div>
  @endif
  <div class="tf-container">
    <form class="tf-form" action="{{ route('Transfer Bank') }}" method="POST">
      @csrf
      <div class="group-input">
        <label class="mb-2 form-label d-block">Pilih Bank</label>
        <select name="bank_id" id="bank_id" class="form-control">
          <option value="">Pilih Bank</option>
          @foreach ($banks as $key => $bank)
          <option value="{{ $key }}">{{ $bank }}</option>
          @endforeach
        </select>
      </div>
      <div class="group-input">
        <label class="mb-2 form-label d-block">Nomor Rekening</label>
        <input type="text" name="account_number" id="account_number" class="form-control" placeholder="Masukkan Nomor Rekening" onchange="fetchAccountDetails()">
      </div>
      <div class="group-input">
        <label class="mb-2 form-label d-block">Nama Pemilik Rekening</label>
        <input type="hidden" name="account_name" id="account_name">
        <input type="text" name="accont" id="accont" class="form-control" placeholder="Masukkan Nama Pemilik Rekening" readonly>
      </div>
      <div class="group-input">
        <label class="mb-2 form-label d-block">Jumlah Transfer</label>
        <input type="text" name="amount" id="amount" class="form-control" placeholder="Masukkan Jumlah Transfer" onchange="splitRibuan()">
      </div>
      <div class="group-input">
        <label class="mb-2 form-label d-block">PIN</label>
        <input type="password" name="pin" id="pin" class="form-control" placeholder="Masukkan PIN">
      </div>
      <div class="bottom-navigation-bar bottom-btn-fixed st2">
        <button type="submit" class="tf-btn accent large">Simpan</button>
      </div>
    </form>
  </div>
</div>
@endsection

@push('script')
<script>
function fetchAccountDetails() {
  const accountNumber = document.getElementById('account_number').value;
  const bankId = document.getElementById('bank_id').value;

  if (accountNumber && bankId) {
    fetch(`{{ route('Transfer Bank Get Account Details') }}`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ bank_id: bankId, account_number: accountNumber, _token: '{{ csrf_token() }}' }),
    })
      .then(response => response.json())
      .then(data => {
        if (data.data.accountname) {
          document.getElementById('accont').value = data.data.accountname;
          document.getElementById('account_name').value = data.data.accountname;
        } else {
          alert('Account details not found');
        }
      })
      .catch(error => {
        alert('An error occurred while fetching account details');
      });
  }
}

function splitRibuan() {
  const input = document.querySelector('.value_input');
  let value = input.value.replace(/\D/g, '').replace(/^0+/, '');
  if (value === '') {
    value = '0';
  }
}
</script>
@endpush
