@extends('baak.masterBaak')

@section('title', 'Komentar ke Kaprodi')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 mb-2" style="margin: 20px;" >
            <h2 class="m-0">Komentar yang Dikirim ke Kaprodi</h2>
        </div>
        <div class="col-md-12" style="margin: 20px;">
            <div class="timeline">

                @if ($notifikasi->isEmpty())
                    <div class="text-center p-4">
                        <p class="lead">Belum ada komentar yang dikirim ke Kaprodi.</p>
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
                            <span class="bg-primary">{{ $tanggal }}</span>
                        </div>

                        @foreach ($notifPerTanggal as $notif)
                            @php
                                $data = json_decode($notif->data, true);
                            @endphp
                            <div>
                                <i class="fas fa-user bg-warning"></i>
                                <div class="timeline-item">
                                    <span class="time">
                                        <i class="fas fa-clock"></i>
                                        {{ \Carbon\Carbon::parse($notif->created_at)->format('H:i') }}
                                    </span>
                                    <h3 class="timeline-header">
                                        Anda mengirim komentar untuk Kaprodi
                                        <br>
                                        <small class="text-muted">
                                            Mahasiswa: {{ $data['nama_mahasiswa'] ?? '-' }} (NIM: {{ $data['nim'] ?? '-' }})<br>
                                            Judul: {{ $data['title'] ?? '-' }}
                                        </small>
                                    </h3>
                                    <div class="timeline-body">
                                        {{ $data['message'] ?? '-' }}
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
