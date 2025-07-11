@extends('baak.masterBaak')

@section('title', 'Daftar Mahasiswa')

@section('content')
    {{-- Header --}}
    <section class="m-4 d-flex flex-column flex-lg-row align-items-center justify-content-between">
        <h1 class="text-bold text-primary drop">SKPI Mahasiswa</h1>
    </section>

    {{-- Table --}}
    <section class="m-4 p-3 bg-white rounded shadow-sm">
        <form action="{{ route('baak.skpi.mahasiswa') }}" method="GET" id="filterForm" class="d-flex align-items-center" style="gap: 1rem">
            <label for="status" class="font-weight-normal">
                Status SKPI
                <select name="status" id="status" class="form-control w-auto" onchange="submit()">
                    <option value="" @selected(empty($status))>Semua</option>
                    <option value="Diajukan" @selected($status == 'Diajukan')>Diajukan</option>
                    <option value="Revisi" @selected($status == 'Revisi')>Revisi</option>
                    <option value="Selesai" @selected($status == 'Selesai')>Selesai</option>
                </select>
            </label>
            <label for="angkatan" class="font-weight-normal">
                Angkatan
                <select name="angkatan" id="angkatan" class="form-control w-auto" onchange="submit()">
                    <option value="" @selected(empty($angkatan))>Semua</option>
                    @foreach ($angkatanList as $a)
                    <option value="{{ $a }}" @selected($angkatan == $a)>{{ $a }}</option>
                    @endforeach
                </select>
            </label>
            <label for="prodi" class="font-weight-normal">
                Program Studi
                <select name="prodi" id="prodi" class="form-control w-auto" onchange="submit()">
                    <option value="" @selected(empty($prodi))>Semua</option>
                    @foreach ($prodiList as $a)
                    <option value="{{ $a }}" @selected($prodi == $a)>{{ $a }}</option>
                    @endforeach
                </select>
            </label>
        </form>

        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>NIM Mahasiswa</th>
                    <th>Nama Mahasiswa</th>
                    <th>Angkatan</th>
                    <th>Program Studi</th>
                    <th>Jurusan</th>
                    <th>No. Handphone</th>
                    <th>Status SKPI</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mahasiswa as $m)
                    @php
                        $status = $m->mahasiswa->skpi?->status ?? 'Menunggu';
                        $statusColor = match($status) {
                            'Menunggu' => 'warning',
                            'Diajukan' => 'info',
                            'Revisi' => 'danger',
                            'Selesai' => 'success',
                        }
                    @endphp
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $m->mahasiswa->nim }}</td>
                        <td>{{ $m->nama }}</td>
                        <td>{{ $m->mahasiswa->angkatan }}</td>
                        <td>{{ $m->mahasiswa->prodi->nama_prodi }}</td>
                        <td>{{ $m->mahasiswa->prodi->jurusan->nama_jurusan }}</td>
                        <td>{{ $m->mahasiswa->telepon }}</td>
                        <td>
                            <span class="py-2 px-4 rounded m-auto d-block text-center bg-{{ $statusColor }}">
                                {{ $status }}
                            </span>
                        </td>
                        <td>
                            @if ($status == 'Diajukan' || $status == 'Revisi')
                            <button class="btn btn-primary" title="Lihat SKPI" data-toggle="modal" data-target="#previewSkpi{{ $loop->iteration }}">
                                <i class="fa fa-eye"></i>
                            </button>
                            <button class="btn btn-success" title="Verifikasi SKPI" data-toggle="modal" data-target="#verifikasiSkpi{{ $loop->iteration }}">
                                <i class="fa fa-check"></i>
                            </button>
                            <button class="btn btn-danger" title="Revisi SKPI" data-toggle="modal" data-target="#revisiSkpi{{ $loop->iteration }}">
                                <i class="fa fa-comment"></i>
                            </button>
                            @else
                            <button class="btn btn-primary" title="Lihat SKPI" data-toggle="modal" data-target="#previewSkpi{{ $loop->iteration }}">
                                <i class="fa fa-eye"></i>
                            </button>
                            <button class="btn btn-warning text-white" title="Update SKPI" data-toggle="modal" data-target="#updateSkpi{{ $loop->iteration }}">
                                <i class="fa fa-pen"></i>
                            </button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>


    @foreach ($mahasiswa as $m)
        @php
            $status = $m->mahasiswa->skpi?->status ?? 'Menunggu';
        @endphp
        @if ($status == 'Diajukan' || $status == 'Revisi')
        {{-- Modal Preview SKPI --}}
        <div class="modal fade" id="previewSkpi{{ $loop->iteration }}" tabindex="-1" aria-labelledby="previewSkpiLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                <div class="modal-content">
                    <div class="modal-header align-items-center py-2">
                        <h3 class="modal-title font-weight-bold text-primary" id="previewSkpiLabel">Preview SKPI</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-0 vh-100 overflow-hidden">
                        <div class="my-1 d-flex justify-content-center" style="gap: 1rem">
                            <a class="btn btn-primary"
                                href="{{ str_replace('.docx', '.pdf', $m->mahasiswa->skpi->link) . '?t=' . now()->timestamp}}" download>
                                Download Word
                            </a>
                            <a class="btn btn-danger"
                                href="{{ $m->mahasiswa->skpi->link . '?t=' . now()->timestamp }}" download>
                                Download PDF
                            </a>
                        </div>
                        <embed id="pdfViewer"
                            src="{{ $m->mahasiswa->skpi->link . '?t=' . now()->timestamp }}#toolbar=0" width="100%"
                            height="100%"></embed>
                    </div>
                </div>
            </div>
        </div>
        {{-- Modal Verifikasi SKPI --}}
        <div class="modal fade" id="verifikasiSkpi{{ $loop->iteration }}" tabindex="-1" aria-labelledby="verifikasiSkpiLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <div class="modal-header align-items-center py-2">
                        <h3 class="modal-title font-weight-bold text-success" id="verifikasiSkpiLabel">Verifikasi SKPI</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('baak.skpi.verification') }}" method="POST">
                    <div class="modal-body">
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="nim" value="{{ $m->mahasiswa->nim }}">
                        <input type="text" name="nomor_skpi">
                        <input type="text" name="nomor_ijazah">
                        <input type="date" name="tanggal_masuk">
                        <input type="date" name="tanggal_lulus">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success text-white">
                            Ya, Verifikasi
                        </button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- Modal Revisi SKPI --}}
        <div class="modal fade" id="revisiSkpi{{ $loop->iteration }}" tabindex="-1" aria-labelledby="revisiSkpiLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <div class="modal-header align-items-center py-2">
                        <h3 class="modal-title font-weight-bold text-danger" id="revisiSkpiLabel">Kirim Permintaan Revisi & Komentar</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('baak.skpi.revision') }}" method="POST">
                    <div class="modal-body">
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="nim" value="{{ $m->mahasiswa->nim }}">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger text-white">
                            Kirim
                        </button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        @else
        {{-- Modal Preview SKPI --}}
        <div class="modal fade" id="previewSkpi{{ $loop->iteration }}" tabindex="-1" aria-labelledby="previewSkpiLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                <div class="modal-content">
                    <div class="modal-header align-items-center py-2">
                        <h3 class="modal-title font-weight-bold text-primary" id="previewSkpiLabel">Preview SKPI</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-0 vh-100 overflow-hidden">
                        <div class="my-1 d-flex justify-content-center" style="gap: 1rem">
                            <a class="btn btn-primary"
                                href="{{ str_replace('.docx', '.pdf', $m->mahasiswa->skpi->link) . '?t=' . now()->timestamp}}" download>
                                Download Word
                            </a>
                            <a class="btn btn-danger"
                                href="{{ $m->mahasiswa->skpi->link }}" download>
                                Download PDF
                            </a>
                        </div>
                        <embed id="pdfViewer"
                            src="{{ $m->mahasiswa->skpi->link }}" width="100%"
                            height="100%"></embed>
                    </div>
                </div>
            </div>
        </div>
        {{-- Modal Update SKPI --}}
        <div class="modal fade" id="updateSkpi{{ $loop->iteration }}" tabindex="-1" aria-labelledby="updateSkpiLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <div class="modal-header align-items-center py-2">
                        <h3 class="modal-title font-weight-bold text-warning" id="updateSkpiLabel">Update SKPI Mahasiswa</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('baak.skpi.verification') }}" method="POST">
                    <div class="modal-body">
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="nim" value="{{ $m->mahasiswa->nim }}">
                        @php
                            $skpi = $m->mahasiswa->skpi;
                        @endphp
                        <input type="text" name="nomor_skpi" value="{{ $skpi->nomor_skpi }}">
                        <input type="text" name="nomor_ijazah" value="{{ $skpi->nomor_ijazah }}">
                        <input type="date" name="tanggal_masuk">
                        <input type="date" name="tanggal_lulus">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-warning text-white">
                            Simpan
                        </button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        @endif
    @endforeach
@endsection

@push('scripts')

@endpush
