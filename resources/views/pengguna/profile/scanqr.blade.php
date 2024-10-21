@extends('pengguna.layouts.index')
@section('content')
@section('title-page', 'QR Code')
@include('pengguna.layouts.back')
<div class="app-content mt-3">
  <div class="tf-container">
    <div id="reader" class="fullscreen"></div>
  </div>
  <div class="bottom-navigation-bar bottom-btn-fixed">
    <div class="tf-container d-flex gap-3">
      <a href="{{ route('My QR Code Page') }}" class="tf-btn outline medium">Back</a>
      <a href="javascript:void(0)" class="tf-btn accent medium">Scan QR</a>
    </div>
  </div>
</div>
@endsection
@push('style')
<style>
  /* Make the QR scanner full screen */
  .fullscreen {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 999;
    background-color: black;
  }
</style>
@endpush
@push('script')
<script src="{{ asset('/assets/html5-qrcode.min.js') }}" type="text/javascript"></script>
<script>
async function openScan() {
  try {
    const cameras = await Html5Qrcode.getCameras();
    if (cameras && cameras.length) {
      const backCamera = cameras.find(camera => camera.label.toLowerCase().includes('back'));
      const frontCamera = cameras.find(camera => camera.label.toLowerCase().includes('front'));
      const selectedCamera = backCamera || frontCamera || cameras[0];
      
      const html5QrCode = new Html5Qrcode("reader");
      await html5QrCode.start(selectedCamera.id, {
        fps: 60,
        qrbox: function(viewfinderWidth, viewfinderHeight) {
          let minEdgePercentage = 0.7; // Use 70% of the smaller dimension
          let minEdgeSize = Math.min(viewfinderWidth, viewfinderHeight);
          let qrboxSize = Math.floor(minEdgeSize * minEdgePercentage);
          return {width: qrboxSize, height: qrboxSize};
        },
      }, (decodedText, decodedResult) => {
        handleQrCodeResult(decodedText);
      });
    } else {
      throw new Error('No cameras found');
    }
  } catch (error) {
    console.error('Error starting QR code scanner:', error);  
  }
}
 
function handleQrCodeResult(result) {
  if(result.startsWith('By') || result.startsWith('USR')) {
    window.location.href = `/transfer-qr?kode_user=${result}`;
    return;
  }
  const data = JSON.parse(result);
  if(data.kode_transaksi) {
    window.location.href = `/transaction/checkout?kode_transaksi=${data.kode_transaksi}`;
  } else {
    alert('QR Code tidak valid');
  }
}

document.addEventListener('DOMContentLoaded', () => {
  openScan();
});

window.addEventListener('beforeunload', () => {
  if (html5QrCode) {
    html5QrCode.stop();
  }
});

</script>
@endpush
