@extends('mhs.masterMhs')

@section('title', 'Notifikasi Mahasiswa')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 mb-2" style="margin: 20px;" >
            <h2 class="m-0">Notifikasi</h2>
        </div>
        <div class="col-md-12" style="margin: 20px;">
            <div class="timeline">

                @if ($notifikasi->isEmpty())
                    <div class="text-center p-4">
                        <p class="lead">Tidak ada notifikasi untuk saat ini.</p>
                        <i class="fas fa-bell-slash fa-3x text-muted"></i>
                    </div>
                @else
                    @php
                        $grouped = $notifikasi->groupBy(function($item) {
                            return \Carbon\Carbon::parse($item->created_at)->format('d M Y');
                        });
                    @endphp

                    @foreach ($grouped as $tanggal => $notifPerTanggal)
                        <div class="time-label">
                            <span class="bg-green">{{ $tanggal }}</span>
                        </div>

                        @foreach ($notifPerTanggal as $notif)
                            <div>
                                <i class="fas fa-user bg-info"></i>
                                <div class="timeline-item">
                                    <span class="time">
                                        <i class="fas fa-clock"></i>
                                        {{ \Carbon\Carbon::parse($notif->created_at)->format('H:i') }}
                                    </span>
                                    <h3 class="timeline-header">
                                        <a href="#">{{ $notif->data['admin_name'] ?? 'Admin' }}</a> mengirimkan komentar
                                        {{-- TAMBAHKAN INI UNTUK MENAMPILKAN NAMA KEGIATAN --}}
                                        @if (isset($notif->data['nama_kegiatan']))
                                            <br><small class="text-muted">Untuk Kegiatan: {{ $notif->data['nama_kegiatan'] }}</small>
                                        @endif
                                    </h3>
                                    <div class="timeline-body">
                                        {{ $notif->data['komentar'] ?? 'Tidak ada komentar.' }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endforeach

                    <div>
                        <i class="fas fa-clock bg-gray"></i>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
