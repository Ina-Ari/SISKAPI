@extends('master')

@section('title', 'Kegiatan Belum Terverifikasi')

@section('content')
    <form id="formVerify" method="POST" action="{{ route('kegiatan.verify_selected') }}">
        @csrf
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="col-sm-6">
                    <h3 class="m-0">Kegiatan Belum Diverifikasi</h3>
                </div>
                <div class="col-sm-6 text-right">
                    <button id="btnVerifSelected" type="submit" class="btn btn-primary btn-sm"><i class="fas fa-check"></i>Verif</button>
                    <button id="btnVerifAll" type="submit" class="btn btn-success btn-sm"><i class="fas fa-check-double"></i>Verif All</button>
                </div>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIM</th>
                            <th>Nama Kegiatan</th>
                            <th>Tanggal Kegiatan</th>
                            <th>Status Sertifikat</th>
                            <th>Akurasi</th>
                            <th style="text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kegiatan as $key => $data)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $data->nim }}</td>
                                <td>{{ $data->nama_kegiatan }}</td>
                                <td>{{ \Carbon\Carbon::parse($data->tanggal_kegiatan)->translatedFormat('d F Y') }}</td>
                                <td>
                                    @if ($data->verifsertif === 'True')
                                        <span class="badge badge-success">Terverifikasi</span>
                                    @else
                                        <span class="badge badge-danger">Belum Terverifikasi</span>
                                    @endif
                                </td>
                                <td>{{ $data->akurasi.'%' }}</td>
                                <td style="text-align: center;">
                                    <input type="checkbox" name="selected_kegiatan[]" value="{{ $data->id_kegiatan }}">
                                    <button style="border:none; background-color:transparent;" type="button" class="fas fa-eye" data-toggle="modal" data-target="#editModal{{ $data->id_kegiatan }}">
                                    </button>
                                </td>
                            </tr>

                            <div class="modal fade" id="editModal{{ $data->id_kegiatan }}" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Detail Kegiatan</h5>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label>Nama Kegiatan</label>
                                                <input class="form-control" value="{{ $data->nama_kegiatan }}" disabled style="background-color: white;">
                                            </div>
                                            <div class="form-group">
                                                <label>Tanggal Kegiatan</label>
                                                <input class="form-control"
                                                    value="{{ \Carbon\Carbon::parse($data->tanggal_kegiatan)->translatedFormat('d F Y') }}"
                                                    disabled style="background-color: white;">
                                            </div>
                                            <div class="form-group">
                                                <label>Posisi</label>
                                                <input class="form-control" value="{{ $data->posisi->nama_posisi }}"
                                                    disabled style="background-color: white;">
                                            </div>
                                            <div class="form-group">
                                                <label>Jenis Kegiatan</label>
                                                <input class="form-control"
                                                    value="{{ $data->jenisKegiatan->jenis_kegiatan }}" disabled style="background-color: white;">
                                            </div>
                                            <div class="form-group">
                                                <label>Tingkat Kegiatan</label>
                                                <input class="form-control"
                                                    value="{{ $data->tingkatKegiatan->tingkat_kegiatan }}" disabled style="background-color: white;">
                                            </div>
                                            <div class="form-group">
                                                <label>Poin</label>
                                                <input class="form-control" value="{{ $data->poin->poin }}" disabled style="background-color: white;">
                                            </div>
                                            <div class="form-group">
                                                <label>Status Sertifikat</label>
                                                <input class="form-control"
                                                    value="{{ $data->verifsertif === 'True' ? 'Terverifikasi' : 'Belum Terverifikasi' }}"
                                                    disabled style="background-color: white;">
                                            </div>
                                            <div class="form-group">
                                                <label>Akurasi</label>
                                                <input class="form-control" value="{{ $data->akurasi.'%' }}" disabled style="background-color: white;">
                                            </div>
                                            <div class="form-group">
                                                <label>Sertifikat</label>
                                                <div class="text-center mt-3">
                                                    <img src="{{ '/storage/'.($data->sertifikat) }}" alt="Tidak Dapat Menampilkan Sertifikat" class="img-fluid rounded" style="max-width: 100%; height: auto;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </form>
@endsection
