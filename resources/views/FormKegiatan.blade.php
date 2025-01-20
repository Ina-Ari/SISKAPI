@extends('master')

@section('title', 'Form Kegiatan')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="col-sm-6">
                <h3 class="m-0">Form Kegiatan</h3>
            </div>
        </div>

        <div class="card-body">
            @if (session('success'))
                <div style="color: green;">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div style="color: red;">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('activity.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Kegiatan</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>NIM</label>
                        <input type="text" name="nim" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Nama </label>
                        <input type="text" name="nama_kegiatan" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" name="tanggal_kegiatan" class="form-control" required>
                    </div>
                    <label>Posisi</label>
                    <select name="id_posisi" class="form-control">
                        @foreach ($posisi as $posisi)
                            <option value="{{ $posisi->id_posisi }}">{{ $posisi->nama_posisi }}</option>
                        @endforeach
                    </select>
                    <label>Tingkat Kegiatan</label>
                    <select name="idtingkat_kegiatan" class="form-control">
                        @foreach ($tingkatKegiatan as $tingkatKegiatan)
                            <option value="{{ $tingkatKegiatan->idtingkat_kegiatan }}">{{ $tingkatKegiatan->tingkat_kegiatan }}</option>
                        @endforeach
                    </select>
                    <label>Jenis Kegiatan</label>
                    <select name="idjenis_kegiatan" class="form-control">
                        @foreach ($jenisKegiatan as $jenisKegiatan)
                            <option value="{{ $jenisKegiatan->idjenis_kegiatan }}">{{ $jenisKegiatan->jenis_kegiatan }}</option>
                        @endforeach
                    </select>
                    <div class="form-group">
                        <label for="sertifikat">Upload Sertifikat:</label><br>
                        <input type="file" id="sertifikat" name="sertifikat" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
