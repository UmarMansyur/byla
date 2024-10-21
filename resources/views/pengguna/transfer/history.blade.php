@extends('pengguna.layouts.index')
@section('content')
<div class="header">
  <div class="tf-container h-100">
    <div class="tf-statusbar d-flex align-items-center">
      <a href="{{ route('home') }}" class="float-start"> <i class="icon-left"></i> </a>
      <h3 class="mx-auto">Riwayat Transaksi</h3>
    </div>
  </div>
</div>
<div class="app-section st1 mt-1 mb-5 bg_white_color">
  <div class="tf-container">
    <div class="row mb-5 pb-3 px-3 border-bottom">
      <div class="col-6">
        <div class="inner-left">
          <p>Pendapatan:</p>
          <h4>Rp. {{ number_format($total_income, 0, ',', '.') }}</h4>
        </div>
      </div>
      <div class="col-6 text-end">
        <div class="inner-right">
          <p>Pengeluaran:</p>
          <h4>Rp. {{ number_format($total_outcome, 0, ',', '.') }}</h4>
        </div>
      </div>
    </div>
        {{-- modal filter --}}
        <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="filterModalLabel">Filter Transaksi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="{{ route('History Page') }}" method="get" id="filterForm">
              <div class="modal-body">
                  <div class="mb-3">
                    <label for="startDate" class="form-label">Tanggal Mulai</label>
                    <input type="date" class="form-control" id="startDate" name="startDate" value="{{ request('startDate') }}">
                  </div>
                  <div class="mb-3">
                    <label for="endDate" class="form-label">Tanggal Selesai</label>
                    <input type="date" class="form-control" id="endDate" name="endDate" value="{{ request('endDate') }}">
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                  <button type="submit" class="btn btn-success">Terapkan</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="text-end">
          <button class="btn btn-light ms-2" style="width: 50px; height: auto;" data-bs-toggle="modal" data-bs-target="#filterModal">
            <i class="bx bx-filter"></i>
          </button>
          <a href="/history/download?startDate={{ request('startDate') }}&endDate={{ request('endDate') }}" class="btn btn-success" style="width: 50px; height: auto;">
            <i class="bx bx-download"></i>
          </a>
        </div>
    <div class="trading-month infinite-scroll mb-3 pb-1">
      @foreach ($transactions as $transaction)
      <div class="group-trading-history mb-3 pb-3 border-bottom">
        <a class="tf-trading-history" href="#">
          <div class="inner-left">
              <div class="icon-box rgba_primary">
                @if($transaction->status == 'pending')
                  <i class="bx bx-transfer text-primary" style="font-size: 20px;"></i>
                @elseif($transaction->status == 'success')
                  <i class="bx bx-check-circle text-success" style="font-size: 20px;"></i>
                @else
                  <i class="bx bx-x-circle text-danger" style="font-size: 20px;"></i>
                @endif
              </div>
              <div class="content">
                @if($transaction->kredit > 0)
                  <h4 style="font-size: 13px !important;">
                    Transfer ke {{ $transaction->rekening }}</h4>
                @else
                  <h4 style="font-size: 13px !important;">
                    Transfer dari {{ $transaction->rekening_pengirim }}</h4>
                @endif
                  <p>{{ $transaction->updated_at->format('d M Y H:i') }} WIB</p>
              </div>
          </div>
          @if($transaction->kredit > 0)
          <span class="num-val critical_color" style="font-size: 14px !important;">- Rp. {{ number_format($transaction->kredit, 0, ',', '.') }}</span>
          @else
          <span class="num-val success_color" style="font-size: 14px !important;">+ Rp. {{ number_format($transaction->debit, 0, ',', '.') }}</span>
          @endif
      </a>
      </div>
      @endforeach
      <div class="d-none">
        {{ $transactions->links() }}
      </div>
    </div>
    @if($transactions->isEmpty())
    <div class="text-center">
      <img src="{{ asset('assets/images/404.svg') }}" alt="Empty History" style="width: 400px; height: 400px;">
      <p>Tidak ada transaksi</p>
    </div>
    @endif
  </div>
</div>
@include('pengguna.layouts.bottom')
@endsection

@push('script')
<script type="text/javascript">
  $(document).ready(function() {
      $('.infinite-scroll').jscroll({
        autoTrigger: true,
        loadingHtml: '<div class="text-center flex-column"><i class="bx bx-loader bx-spin font-weight-bold"></i><p>Memuat data...</p></div>',
        padding: 0,
        nextSelector: 'a[rel="next"]',
        contentSelector: 'div.infinite-scroll',
        callback: function() {
          $('nav.pagination').hide();
        }
      });
    });
</script>
@endpush