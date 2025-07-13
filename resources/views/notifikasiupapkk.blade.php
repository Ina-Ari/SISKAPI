@extends('master')

@section('title', 'Komentar ke Mahasiswa')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 mb-2" style="margin: 20px;">
            <h2 class="m-0">Komentar yang Dikirim ke Mahasiswa</h2>
        </div>
        <div class="col-md-12" style="margin: 20px;">
            <div class="timeline">

                @if ($notifikasi->isEmpty())
                    <div class="text-center p-4">
                        <p class="lead">Belum ada komentar yang dikirim ke Mahasiswa.</p>
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
                            <span class="bg-success">{{ $tanggal }}</span>
                        </div>

                        @foreach ($notifPerTanggal as $notif)
                            @php
                                $data = is_array($notif->data) ? $notif->data : json_decode($notif->data, true);
                            @endphp
                            <div>
                                <i class="fas fa-user bg-primary"></i>
                                <div class="timeline-item">
                                    <span class="time">
                                        <i class="fas fa-clock"></i>
                                        {{ \Carbon\Carbon::parse($notif->created_at)->format('H:i') }}
                                    </span>
                                    <h3 class="timeline-header">
                                        Anda mengirim komentar ke mahasiswa
                                        <br>
                                        <small class="text-muted">
                                            Mahasiswa: {{ $data['nama_mahasiswa'] ?? '-' }} (NIM: {{ $data['nim'] ?? '-' }})<br>
                                            Kegiatan: {{ $data['nama_kegiatan'] ?? '-' }}<br>
                                            Tanggal Pengajuan: {{ $data['tanggal_kegiatan'] ?? '-' }}
                                        </small>
                                    </h3>
                                    <div class="timeline-body">
                                        {{ $data['komentar'] ?? $data['message'] ?? '-' }}
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
