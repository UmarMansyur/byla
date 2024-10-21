@section('content')
@extends('pengguna.layouts.index')
<div class="app-header st1">
    <div class="tf-container">
        <div class="tf-topbar d-flex justify-content-center align-items-center">
            <a href="#" class="back-btn"><i class="icon-left white_color"></i></a>
            <h3 class="white_color">Top Up</h3>
        </div>
    </div>
</div>


<div class="card-secton topup-content">
    <div class="tf-container">
        <div class="tf-balance-box">
            <div class="d-flex justify-content-between align-items-center">
                <p>Saldo Anda:</p>
                <h3>Rp. {{ number_format(Auth::user()->saldo->saldo, 0, ',', '.') }}</h3>
            </div>
            <div class="tf-spacing-16"></div>
            <div class="tf-form">
                <div class="group-input input-field input-money">
                    <label for="">Nominal Top Up</label>
                    <input type="text" value="0" required="" class="search-field value_input st1"
                        oninput="splitRibuan()" inputmode="numeric" pattern="^[0-9]*$" id="nominal-input">
                    <span class="icon-clear"></span>
                </div>
            </div>

        </div>

    </div>
    <div class="bottom-navigation-bar">
        <div class="tf-container">
            <a href="#" id="btn-popup-up" class="tf-btn accent large">Selanjutnya</a>
        </div>
    </div>
</div>
<div class="amount-money">
    @if (session('error'))
    <div class="alert alert-danger my-3">
        {{ session('error') }}
    </div>
    @endif
    <div class="tf-container">
        <h3>Jumlah Top Up</h3>
        <ul class="money list-money" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px;">
            <li><a class="tag-money" href="#">10.000</a></li>
            <li><a class="tag-money" href="#">20.000</a></li>
            <li><a class="tag-money" href="#">50.000</a></li>
            <li><a class="tag-money" href="#">100.000</a></li>
            <li><a class="tag-money" href="#">200.000</a></li>
            <li><a class="tag-money" href="#">500.000</a></li>
            <li><a class="tag-money" href="#">1.000.000</a></li>
            <li><a class="tag-money" href="#">2.000.000</a></li>
            <li><a class="tag-money" href="#">5.000.000</a></li>
            <li><a class="tag-money" href="#">10.000.000</a></li>
        </ul>
    </div>
</div>
<div class="tf-panel up">
    <div class="panel_overlay"></div>
    <div class="panel-box panel-up wrap-content-panel">
        <div class="heading">
            <div class="tf-container">
                <div class="d-flex align-items-center position-relative justify-content-center">
                    <i class="icon-close1 clear-panel"></i>
                    <h3>Konfirmasi Top Up</h3>
                </div>
            </div>
        </div>
        <div class="main-topup">
            <form action="{{ route('Topup Store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="tf-container">
                    <div class="group-input input-field">
                        <input type="hidden" name="saldo" id="saldo">
                        <label for="kode-bank" class="">Bank Tujuan:</label>
                        <select name="bank" id="bank" required>
                            <option value="">Pilih Bank</option>
                            @foreach ($bank as $item)
                            <option value="{{ $item->id }}">({{ $item->rekening }}) - {{ $item->bank_account_name }} {{
                                $item->bank_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="group-input input-field">
                        <label for="rekening_pengirim">Rekening Pengirim: </label>
                        <input type="text" name="rekening_pengirim" id="rekening_pengirim" required inputmode="numeric"
                            pattern="^[0-9]*$" oninput="onlyNumber()" placeholder="Masukkan Nomor Rekening">
                    </div>
                    <div class="group-input input-field">
                        <label for="bukti_pembayaran">Bukti Pembayaran: </label>
                        <input type="file" name="bukti_pembayaran" id="bukti_pembayaran" required class="form-control">
                    </div>
                    <div class="group-input input-field">
                        <label for="pin">PIN: </label>
                        <input type="password" name="pin" id="pin" required placeholder="Masukkan PIN">
                    </div>
                    <ul class="info">
                        <li>
                            <h4 class="secondary_color fw_4 d-flex justify-content-between align-items-center">
                                Nominal
                                <a href="#" class="on_surface_color fw_7" id="nominal-topup">Rp. 0</a>
                            </h4>
                        </li>
                        <li>
                            <h4 class="secondary_color fw_4 d-flex justify-content-between align-items-center">
                                Biaya Admin <a href="#" class="success_color fw_7">Gratis</a>
                            </h4>
                        </li>
                    </ul>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="total">
                            <h4 class="secondary_color fw_4">Total</h4>
                            <h2 id="total-topup">Rp. 0</h2>
                        </div>
                        <button type="button" class="tf-btn accent large" id="btn-topup-final" onclick="topup_process()"><i class="icon-secure1"></i>Top Up</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
@push('script')
<script>
function splitRibuan() {
    const input = document.querySelector('.value_input');
    let value = input.value.replace(/\D/g, '').replace(/^0+/, '');
    if (value === '') {
        value = '0';
    }
    const formattedValue = new Intl.NumberFormat('id-ID').format(value);
    input.value = formattedValue;
}
document.querySelector('.value_input').addEventListener('input', splitRibuan);
document.querySelector('#btn-popup-up').addEventListener('click', function() {
  const input = document.querySelector('.value_input');
  let value = input.value.replace(/\D/g, '').replace(/^0+/, '');
  if (value === '') {
    value = '0';
  }
  const formattedValue = new Intl.NumberFormat('id-ID').format(value);
  document.querySelector('#nominal-topup').textContent = formattedValue ? formattedValue : '0';
  document.querySelector('#total-topup').textContent = formattedValue ? formattedValue : '0';
  document.querySelector('#saldo').value = formattedValue;
  input.value = formattedValue;
});


function onlyNumber() {
  const input = document.querySelector('#saldo');
  input.value = input.value.replace(/\D/g, '').replace(/^0+/, '');
}
function topup_process() {
    document.querySelector('#btn-topup-final').innerHTML = '<i class="bx bx-loader bx-spin font-size-16 align-middle me-2"></i>Loading...';
    document.querySelector('#btn-topup-final').disabled = true;
    document.querySelector('form').submit();
};

</script>
@endpush