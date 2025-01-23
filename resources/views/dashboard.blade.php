@extends('master')

@section('title', 'Dashboard')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $jumlahMahasiswa }}</h3>
                            <p>Mahasiswa Terdaftar</p>
                        </div>
                        <div class="icon">
                            <i class="nav-icon fas fa-users"></i>
                        </div>
                        <a href="{{ route('mahasiswa.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $jumlahKegiatan }}</h3>
                            <p>Kegiatan Diajukan</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                    <!-- ./col -->
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $terverifikasi }}<sup style="font-size: 20px"></sup></h3>
                            <p>Kegiatan Terverifikasi</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <a href="{{ route('kegiatan.index') }}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3 style="color: white">{{ $belumterverifikasi }}<sup style="font-size: 20"></sup></h3>
                            <p style="color: white">Kegiatan Belum Terverifikasi</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-exclamation-circle"></i>
                        </div>
                        <a  href="{{ route('kegiatan_not_verified') }}" class="small-box-footer" style="color: white !important;">More info <i
                                class="fas fa-arrow-circle-right" style="color: white"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
 @endsection
