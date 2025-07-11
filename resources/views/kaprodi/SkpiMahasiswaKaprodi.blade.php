@extends('kaprodi.masterKaprodi')

@section('title', 'Daftar Mahasiswa')

@section('content')
    {{-- Header --}}
    <section class="m-4 d-flex flex-column flex-lg-row align-items-center justify-content-between">
        <h1 class="text-bold text-primary drop">SKPI Mahasiswa</h1>
        <button type="button" class="btn btn-primary py-2 px-4" data-toggle="modal" data-target="#templatePreview">
            <i class="fa fa-eye mr-2"></i>
            Lihat Template SKPI
        </button>
    </section>

    {{-- Table --}}
    <section class="m-4 p-3 bg-white rounded shadow-sm">
        <form action="{{ route('kaprodi.skpi.mahasiswa') }}" method="GET" id="filterForm" class="d-flex align-items-center" style="gap: 1rem">
            <label for="status" class="font-weight-normal">
                Status SKPI
                <select name="status" id="status" class="form-control w-auto" onchange="submit()">
                    <option value="" @selected(empty($status))>Semua</option>
                    <option value="Menunggu" @selected($status == 'Menunggu')>Menunggu</option>
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
        </form>

        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>NIM Mahasiswa</th>
                    <th>Nama Mahasiswa</th>
                    <th>Angkatan</th>
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
                        <td>{{ $m->mahasiswa->telepon }}</td>
                        <td>
                            <span class="py-2 px-4 rounded m-auto d-block text-center bg-{{ $statusColor }}">
                                {{ $status }}
                            </span>
                        </td>
                        <td>
                            @if ($status == 'Menunggu')
                            <button class="btn btn-success" title="Buatkan SKPI" data-toggle="modal" data-target="#createSkpi{{ $loop->iteration }}">
                                <i class="fa fa-plus"></i>
                            </button>
                            @elseif ($status == 'Diajukan' || $status == 'Revisi')
                            <button class="btn btn-primary" title="Lihat SKPI" data-toggle="modal" data-target="#previewSkpi{{ $loop->iteration }}">
                                <i class="fa fa-eye"></i>
                            </button>
                            <button class="btn btn-warning text-white" title="Edit SKPI" data-toggle="modal" data-target="#editSkpi{{ $loop->iteration }}">
                                <i class="fa fa-pen"></i>
                            </button>
                            @else
                            <button class="btn btn-primary" title="Lihat SKPI" data-toggle="modal" data-target="#previewSkpi{{ $loop->iteration }}">
                                <i class="fa fa-eye"></i>
                            </button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>


    {{-- Modal Preview Template --}}
    <div class="modal fade" id="templatePreview" tabindex="-1" aria-labelledby="templatePreviewLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
            <div class="modal-content">
                <div class="modal-header align-items-center py-2">
                    <h3 class="modal-title font-weight-bold text-primary" id="templatePreviewLabel">Template SKPI</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-0 vh-100 overflow-hidden">
                    <a class="btn btn-danger d-inline d-md-none"
                        href="{{ asset("storage/$templateFullPath") . '?t=' . now()->timestamp }}" target="_blank">
                        See PDF
                    </a>
                    <embed id="pdfViewer" src="{{ asset("storage/$templateFullPath") . '?t=' . now()->timestamp }}#toolbar=0" width="100%"
                        height="100%"></embed>
                </div>
            </div>
        </div>
    </div>

    @foreach ($mahasiswa as $m)
        @php
            $status = $m->mahasiswa->skpi?->status ?? 'Menunggu';
        @endphp
        @if ($status == 'Menunggu')
        {{-- Modal Create SKPI --}}
        <div class="modal fade" id="createSkpi{{ $loop->iteration }}" tabindex="-1" aria-labelledby="createSkpiLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header align-items-center py-2">
                        <h3 class="modal-title font-weight-bold text-success" id="createSkpiLabel">Buat & Ajukan SKPI</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="mb-1">Apakah anda ingin membuatkan SKPI pada mahasiswa ini?</p>
                        Nama : <strong>{{ $m->nama }}</strong><br>
                        NIM : <strong>{{ $m->mahasiswa->nim }}</strong><br>
                        Angkatan : <strong>{{ $m->mahasiswa->angkatan }}</strong><br>
                    </div>
                    <div class="modal-footer">
                        <form action="{{ route('kaprodi.skpi.create') }}" method="POST">
                            @csrf
                            <input type="hidden" name="nim" value="{{ $m->mahasiswa->nim }}">
                            <button type="submit" class="btn btn-success">
                                Ya, Buatkan & Ajukan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @elseif ($status == 'Diajukan' || $status == 'Revisi')
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
                                href="{{ $m->mahasiswa->skpi->link . '?t=' . now()->timestamp}}" download>
                                Download PDF
                            </a>
                        </div>
                        <embed id="pdfViewer"
                            src="{{ $m->mahasiswa->skpi->link . '?t=' . now()->timestamp}}#toolbar=0" width="100%"
                            height="100%"></embed>
                    </div>
                </div>
            </div>
        </div>
        {{-- Modal Edit SKPI --}}
        <div class="modal fade" id="editSkpi{{ $loop->iteration }}" tabindex="-1" aria-labelledby="editSkpiLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header align-items-center py-2">
                        <h3 class="modal-title font-weight-bold text-warning" id="editSkpiLabel">Edit & Ajukan Ulang SKPI</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="mb-1">Apakah Anda yakin ingin mengedit dan mengajukan ulang SKPI untuk mahasiswa berikut?</p>
                        Nama : <strong>{{ $m->nama }}</strong><br>
                        NIM : <strong>{{ $m->mahasiswa->nim }}</strong><br>
                        Angkatan : <strong>{{ $m->mahasiswa->angkatan }}</strong><br>
                        <p class="text-danger font-italic mt-2">
                            *Jika Anda ingin mengubah isi data SKPI, silakan ubah terlebih dahulu melalui menu <strong>"Formulir SKPI"</strong>.
                        </p>
                    </div>
                    <div class="modal-footer">
                        <form action="{{ route('kaprodi.skpi.create') }}" method="POST">
                            @csrf
                            <input type="hidden" name="nim" value="{{ $m->mahasiswa->nim }}">
                            <button type="submit" class="btn btn-warning text-white">
                                Ya, Simpan & Ajukan Ulang
                            </button>
                        </form>
                    </div>
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
        @endif
    @endforeach
@endsection

@push('scripts')

@endpush
