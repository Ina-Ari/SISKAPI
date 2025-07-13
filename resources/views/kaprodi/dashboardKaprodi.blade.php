@extends('kaprodi.masterKaprodi')

@section('title', 'Dashboard')

@section('content')
<!-- Content Header -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
            </div>
        </div>
    </div>
</div>

<!-- Main content -->
<section class="content pt-2">
    <div class="container-fluid">

        <div class="row">
            <!-- Status Boxes + Grafik -->
            <div class="col-md-9">
                <div class="row">
                    {{-- <div class="col-md-4 mb-3">
                        <div class="small-box bg-danger text-white rounded shadow-sm p-3 position-relative">
                            <div class="mb-0">
                                <p class="mb-0">Tidak Terpenuhi <i class="fas fa-times"></i></p>
                                <h4 class="fw-bold">{{ $statusCounts['tidakterpenuhi'] ?? 0 }}</h4>
                            </div>
                        </div>
                    </div> --}}
                    <div class="col-md-4 mb-3">
                        <div class="small-box bg-primary text-white rounded shadow-sm p-3 position-relative">
                            <div class="mb-0">
                                <p class="mb-0">Telah Diajukan <i class="fas fa-briefcase"></i></p>
                                <h4 class="fw-bold">{{ $statusCounts['Diajukan'] ?? 0 }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="small-box bg-info text-white rounded shadow-sm p-3 position-relative">
                            <div class="mb-0">
                                <p class="mb-0">Menunggu Verif <i class="fas fa-hourglass-half"></i></p>
                                <h4 class="fw-bold">{{ $statusCounts['Menunggu'] ?? 0 }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="small-box bg-warning text-white rounded shadow-sm p-3 position-relative">
                            <div class="mb-0">
                                <p class="mb-0">Revisi <i class="fas fa-pen-square"></i></p>
                                <h4 class="fw-bold">{{ $statusCounts['Revisi'] ?? 0 }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="small-box bg-success text-white rounded shadow-sm p-3 position-relative">
                            <p class="mb-0">Telah Diverifikasi <i class="fas fa-check-square"></i></p>
                            <h4 class="fw-bold">{{ $statusCounts['Selesai'] ?? 0 }}</h4>
                        </div>
                    </div>
                </div>

                <!-- Grafik -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ $today }}</h3>
                    </div>
                    <div class="card-body">
                        <canvas id="grafikMei" height="200"></canvas>
                    </div>
                </div>
            </div>

            <!-- Info Kaprodi -->
            <div class="col-md-3">
                <div class="card bg-primary text-white mb-3">
                    <div class="card-body text-center">
                        <img src="{{ Auth::user()->picture ? '../storage/'. Auth::user()->picture : asset('../storage/fotoprofil/user.jpeg') }}" class="rounded-circle mb-2" alt="Kaprodi" width="80" height="80">
                        <h4>{{ Auth::user()->nama }}</h4>
                        <p>{{ Auth::user()->kepalaProdi->nip }}</p>
                    </div>
                </div>
                <div class="card md-3">
                    <div class="card-header">
                        <h3 class="card-title">{{ $today }}</h3>
                    </div>
                    <div class="card-body text-center">
                        <strong>{{ $dayName }}</strong><br>{{ $dayNumber }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    const ctx = document.getElementById('grafikMei').getContext('2d');
    const grafikMei = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($tanggalLabels) !!},
            datasets: [
                 {
                    label: 'Diajukan',
                    data: {!! json_encode($grafikDataset['Diajukan']) !!},
                    borderColor: 'blue',
                    fill: false
                },
                {
                    label: 'Menunggu',
                    data: {!! json_encode($grafikDataset['Menunggu']) !!},
                    borderColor: 'skyblue',
                    fill: false
                },
                {
                    label: 'Revisi',
                    data: {!! json_encode($grafikDataset['Revisi']) !!},
                    borderColor: 'orange',
                    fill: false
                },
                {
                    label: 'Selesai',
                    data: {!! json_encode($grafikDataset['Selesai']) !!},
                    borderColor: 'green',
                    fill: false
                },
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Jumlah'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Tanggal'
                    }
                }
            }
        }
    });
</script>

@endpush
