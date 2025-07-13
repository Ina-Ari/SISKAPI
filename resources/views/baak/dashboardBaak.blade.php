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

    <!-- Welcome -->
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

    <!-- Statistik -->
    <div class="row">
    <!-- Total Pengajuan -->
    <div class="col-lg-3 col-6 mb-3">
        <div class="small-box d-flex flex-column align-items-start justify-content-center text-start px-4 py-4"
            style="background-color: #3B82F6; color: white; border-radius: 0.25rem; height: 150px;">
        <i class="fas fa-file-alt fa-2x mt-3"></i>
        <h3 class="mt-2 mb-0">{{ $total_pengajuan }}</h3>
        <p style="font-size: 13px;">Total Pengajuan SKPI</p>
        </div>
    </div>

    <!-- Diajukan -->
    <div class="col-lg-3 col-6 mb-3">
        <div class="small-box bg-info text-white d-flex flex-column align-items-start justify-content-center text-start px-4 py-4"
            style="border-radius: 0.25rem; height: 150px;">
        <i class="fas fa-hourglass-half fa-2x mt-3"></i>
        <h3 class="mt-2 mb-0">{{ $diajukan }}</h3>
        <p style="font-size: 13px;">Diajukan</p>
        </div>
    </div>

    <!-- Revisi -->
    <div class="col-lg-3 col-6 mb-3">
        <div class="small-box bg-danger text-white d-flex flex-column align-items-start justify-content-center text-start px-4 py-4"
            style="border-radius: 0.25rem; height: 150px;">
        <i class="fas fa-edit fa-2x mt-3"></i>
        <h3 class="mt-2 mb-0">{{ $revisi }}</h3>
        <p style="font-size: 13px;">Revisi</p>
        </div>
    </div>

    <!-- Selesai -->
    <div class="col-lg-3 col-6 mb-3">
        <div class="small-box bg-success text-white d-flex flex-column align-items-start justify-content-center text-start px-4 py-4"
            style="border-radius: 0.25rem; height: 150px;">
        <i class="fas fa-check-circle fa-2x mt-3"></i>
        <h3 class="mt-2 mb-0">{{ $selesai }}</h3>
        <p style="font-size: 13px;">Selesai</p>
        </div>
    </div>
    </div>

    <!-- Grafik -->
    <div class="row">
      <div class="col-lg-7 connectedSortable">
        <div class="card mb-2">
          <div class="card-header">
            <h3 class="card-title">Statistik Pengajuan SKPI</h3>
          </div>
          <div class="card-body">
            <div id="skpi-chart" style="min-height: 250px;"></div>
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
        { name: 'Total Pengajuan', data: {!! json_encode($datasets['total_pengajuan']) !!} },
        { name: 'Diajukan', data: {!! json_encode($datasets['diajukan']) !!} },
        { name: 'Revisi', data: {!! json_encode($datasets['revisi']) !!} },
        { name: 'Selesai', data: {!! json_encode($datasets['selesai']) !!} },
    ],
    chart: {
        type: 'area',
        height: 250,
        toolbar: { show: false }
    },
    colors: ['#3B82F6', '#0dcaf0', '#dc3545', '#198754'], // << warna disesuaikan
    dataLabels: { enabled: false },
    stroke: { curve: 'smooth' },
    fill: { type: 'gradient', gradient: { opacityFrom: 0.5, opacityTo: 0.1 } },
    xaxis: {
        categories: {!! json_encode($tanggalLabels) !!},
        labels: {
            rotate: -45,
            style: {
                fontSize: '12px'
            }
        }
    },
    yaxis: {
        min: 0,
        tickAmount: 5,
        forceNiceScale: true,
        labels: {
            formatter: function (val) {
                return Math.round(val);
            }
        }
    },
    tooltip: {
        x: {
            show: false
        }
    }
};

const skpi_chart = new ApexCharts(document.querySelector("#skpi-chart"), skpi_chart_options);
skpi_chart.render();
</script>
@endpush
