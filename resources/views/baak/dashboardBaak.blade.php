@extends('baak.masterBaak')

@section('title', 'Dashboard BAAK')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <h4 class="m-0 font-weight-bold text-primary">Dashboard</h4>
  </div>
</div>

<section class="content">
  <div class="container-fluid">

    <!-- Welcome Card -->
<div class="card mb-4 position-relative" id="welcome-card" style="background: linear-gradient(90deg, #4150B5, #4A67D6); color: white;">
  <div class="card-body">
    <button class="close text-white position-absolute" onclick="document.getElementById('welcome-card').remove()"
            style="top: 10px; right: 15px; background: none; border: none; font-size: 20px;">
      &times;
    </button>
    <h5 class="text-white">Selamat Datang, <strong>Admin BAAK</strong></h5>
    <p class="text-white mb-0">Pantau pengajuan SKPI mahasiswa pada dashboard ini.</p>
  </div>
</div>

   <div class="row">
  <!-- Box 1 -->
   <div class="col-lg-3 col-6 mb-3">
    <div class="small-box d-flex flex-column align-items-start justify-content-center text-start px-4 py-4 gap-2"
         style="background-color: #3B82F6; color: white; border-radius: 0.25rem; height: 150px;">
      <i class="fas fa-file-alt fa-2x"></i>
      <h3 class="mt-2 mb-0">582</h3>
      <p style="font-size: 13px; margin: 0;">Total Pengajuan SKPI</p>
    </div>
  </div>


  <!-- Box 2 -->
  <div class="col-lg-3 col-6 mb-3">
    <div class="small-box d-flex flex-column align-items-start justify-content-center text-start px-4 py-4 gap-2"
         style="background-color: #EAB308; color: white; border-radius: 0.25rem; height: 150px;">
      <i class="fas fa-sync-alt fa-2x mb-2"></i>
      <h3 class="mt-2 mb-0">320</h3>
      <p style="font-size: 13px; margin: 0;">Proses Verifikasi</p>
    </div>
  </div>

  <!-- Box 3 -->
  <div class="col-lg-3 col-6 mb-3">
     <div class="small-box d-flex flex-column align-items-start justify-content-center text-start px-4 py-4 gap-2"
         style="background-color: #059669; color: white; border-radius: 0.25rem; height: 150px;">
      <i class="fas fa-check-circle fa-2x mb-2"></i>
      <h3 class="mt-2 mb-0">53</h3>
      <p style="font-size: 13px; margin: 0;">Telah Diverifikasi</p>
    </div>
  </div>

  <!-- Box 4 -->
  <div class="col-lg-3 col-6 mb-3">
     <div class="small-box d-flex flex-column align-items-start justify-content-center text-start px-4 py-4 gap-2"
         style="background-color: #BA2532; color: white; border-radius: 0.25rem; height: 150px;">
      <i class="fas fa-exclamation-triangle fa-2x mb-2"></i>
      <h3 class="mt-2 mb-0">48</h3>
      <p style="font-size: 13px; margin: 0;">Pengajuan Direvisi</p>
    </div>
  </div>
</div>
    <div class="row">
    <div class="col-lg-7 connectedSortable">
        <div class="card mb-4">
        <div class="card-header">
            <h3 class="card-title">Statistik Pengajuan SKPI</h3>
        </div>
        <div class="card-body">
            <div id="skpi-chart" style="min-height: 300px;"></div>
        </div>
        </div>
    </div>
    </div>
        </div>
      </section>
@endsection


{{-- @extends('baak.masterBaak')

@section('title', 'Dashboard BAAK')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <h4 class="m-0 font-weight-bold text-primary">Dashboard</h4>
  </div>
</div>

<section class="content">
  <div class="container-fluid">

    <!-- Welcome Card -->
    <div class="card mb-4 position-relative" id="welcome-card" style="background: linear-gradient(90deg, #4150B5, #4A67D6); color: white;">
      <div class="card-body">
        <button class="close text-white position-absolute" onclick="document.getElementById('welcome-card').remove()"
                style="top: 10px; right: 15px; background: none; border: none; font-size: 20px;">
          &times;
        </button>
        <h5 class="text-white">Selamat Datang, <strong>Admin BAAK</strong></h5>
        <p class="text-white mb-0">Pantau pengajuan SKPI mahasiswa pada dashboard ini.</p>
      </div>
    </div>

    <!-- Kotak Statistik -->
    <div class="row">
      <div class="col-lg-3 col-6 mb-3">
        <div class="small-box d-flex flex-column align-items-start justify-content-center text-start px-4 py-4"
             style="background-color: #3B82F6; color: white; border-radius: 0.25rem; height: 150px;">
          <i class="fas fa-file-alt fa-2x mt-3"></i>
          <h3 class="mt-2 mb-0">{{ $total_pengajuan }}</h3>
          <p style="font-size: 13px;">Total Pengajuan SKPI</p>
        </div>
      </div>

      <div class="col-lg-3 col-6 mb-3">
        <div class="small-box d-flex flex-column align-items-start justify-content-center text-start px-4 py-4"
             style="background-color: #EAB308; color: white; border-radius: 0.25rem; height: 150px;">
          <i class="fas fa-sync-alt fa-2x mb-2 mt-3"></i>
          <h3 class="mt-2 mb-0">{{ $proses_verifikasi }}</h3>
          <p style="font-size: 13px;">Proses Verifikasi</p>
        </div>
      </div>

      <div class="col-lg-3 col-6 mb-3">
        <div class="small-box d-flex flex-column align-items-start justify-content-center text-start px-4 py-4"
             style="background-color: #059669; color: white; border-radius: 0.25rem; height: 150px;">
          <i class="fas fa-check-circle fa-2x mb-2 mt-3"></i>
          <h3 class="mt-2 mb-0">{{ $telah_diverifikasi }}</h3>
          <p style="font-size: 13px;">Telah Diverifikasi</p>
        </div>
      </div>

      <div class="col-lg-3 col-6 mb-3">
        <div class="small-box d-flex flex-column align-items-start justify-content-center text-start px-4 py-4"
             style="background-color: #BA2532; color: white; border-radius: 0.25rem; height: 150px;">
          <i class="fas fa-exclamation-triangle fa-2x mb-2 mt-3"></i>
          <h3 class="mt-2 mb-0">{{ $pengajuan_direvisi }}</h3>
          <p style="font-size: 13px;">Pengajuan Direvisi</p>
        </div>
      </div>
    </div>

    <!-- Chart SKPI -->
    <div class="row">
      <div class="col-lg-7 connectedSortable">
        <div class="card mb-4">
          <div class="card-header">
            <h3 class="card-title">Statistik Pengajuan SKPI</h3>
          </div>
          <div class="card-body">
            <div id="skpi-chart" style="min-height: 300px;"></div>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js" crossorigin="anonymous"></script>

<script>
   const skpi_chart_options = {
    series: [
        { name: 'Total Pengajuan SKPI', data: {!! json_encode($datasets['total_pengajuan']) !!} },
        { name: 'Proses Verifikasi', data: {!! json_encode($datasets['proses_verifikasi']) !!} },
        { name: 'Telah Diverifikasi', data: {!! json_encode($datasets['telah_diverifikasi']) !!} },
        { name: 'Pengajuan Direvisi', data: {!! json_encode($datasets['pengajuan_direvisi']) !!} },
    ],
    chart: {
        type: 'area',
        height: 230,
        toolbar: { show: false }
    },
    colors: ['#3B82F6', '#EAB308', '#059669', '#BA2532'],
    dataLabels: { enabled: false },
    stroke: { curve: 'smooth' },
    fill: { type: 'gradient', gradient: { opacityFrom: 0.5, opacityTo: 0.1 } },
    xaxis: {
        type: 'datetime',
        categories: {!! json_encode($tanggalLabels) !!}, // Formatnya harus ISO (yyyy-MM-dd)
        labels: {
            format: "MMM 'yy" // untuk tampil Jan '25, Feb '25, dst
        }
    },
    tooltip: {
        x: {
            format: "MMMM yyyy"
        }
    }
};
    const skpi_chart = new ApexCharts(document.querySelector("#skpi-chart"), skpi_chart_options);
    skpi_chart.render();
</script>
@endpush



 --}}
