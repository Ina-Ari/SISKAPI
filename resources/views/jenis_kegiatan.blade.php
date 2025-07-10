@extends('master')

@section('title', 'Jenis Kegiatan')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="col-sm-6">
            <h3 class="m-0">Jenis Kegiatan</h3>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addModal">+ New</button>
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>No.</th>
            <th>Jenis Kegiatan</th>
            <th>Kategori SKPI</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
            @foreach ( $data as $key=>$item)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $item->jenis_kegiatan }}</td>
                    @php
                        $kategori_skpi = match($item->kategori_skpi) {
                            'kerja' => 'Pengalaman Kerja',
                            default => ucfirst($item->kategori_skpi ?? 'Tidak diketahui'),
                        }
                    @endphp
                    <td>{{ $kategori_skpi }}</td>
                    <td>
                        <button class="btn btn-warning" data-toggle="modal" data-target="#editModal{{ $item->idjenis_kegiatan }}"><i class="fa fa-pen"></i></button>
                        <form action="{{ route('upapkk.destroyJenisKegiatan', $item->idjenis_kegiatan) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-delete"><i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                </tr>

                <div class="modal fade" id="editModal{{ $item->idjenis_kegiatan }}" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form action="{{ route('upapkk.updateJenisKegiatan', $item->idjenis_kegiatan) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Post</h5>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group mb-3">
                                        <label>Jenis Kegiatan</label>
                                        <input type="text" name="jenis_kegiatan" class="form-control" value="{{ $item->jenis_kegiatan }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="kategori_skpi" class="form-label">Kategori SKPI</label>
                                        <select name="kategori_skpi" id="kategori_skpi" class="form-control" required>
                                            <option value="organisasi" @selected($item->kategori_skpi == 'organisasi')>
                                                Organisasi
                                            </option>
                                            <option value="aktivitas" @selected($item->kategori_skpi == 'aktivitas')>
                                                Aktivitas
                                            </option>
                                            <option value="pelatihan" @selected($item->kategori_skpi == 'pelatihan')>
                                                Pelatihan
                                            </option>
                                            <option value="kerja" @selected($item->kategori_skpi == 'kerja')>
                                                Pengalaman Kerja
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
      </table>

        <div class="modal fade" id="addModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="{{ route('upapkk.storeJenisKegiatan') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Jenis Kegiatan</h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group mb-3">
                                <label>Jenis Kegiatan</label>
                                <input type="text" name="jenis_kegiatan" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="kategori_skpi" class="form-label">Kategori SKPI</label>
                                <select name="kategori_skpi" id="kategori_skpi" class="form-control" required>
                                    <option value="">-- Pilih Kategori --</option>
                                    <option value="organisasi">Organisasi</option>
                                    <option value="aktivitas">Aktivitas</option>
                                    <option value="pelatihan">Pelatihan</option>
                                    <option value="kerja">Pengalaman Kerja</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
  </div>
@endsection
