@extends('master')

@section('title', 'Kegiatan Belum Terverifikasi')

@section('content')
    <form id="formVerify" method="POST" action="{{ route('upapkk.verifSelected') }}">
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
                                {{-- Access the nim through the 'mahasiswa' relationship which links to User->mahasiswa, then User->username (assuming NIM is stored in username or nim field) --}}
                                <td>{{ $data->mahasiswa->user->username ?? $data->mahasiswa->nim }}</td>
                                <td>{{ $data->nama_kegiatan }}</td>
                                <td>{{ \Carbon\Carbon::parse($data->tanggal_kegiatan)->translatedFormat('d F Y') }}</td>
                                <td>
                                    @if ($data->status_sertif === 'true')
                                        <span class="badge badge-success">Terverifikasi</span>
                                    @else
                                        <span class="badge badge-danger">Belum Terverifikasi</span>
                                    @endif
                                </td>
                                <td>{{ $data->akurasi.'%' }}</td>
                                <td style="text-align: center;">
                                    <input type="checkbox" name="selected_kegiatan[]" value="{{ $data->id }}">
                                    <button style="border:none; background-color:transparent;" type="button" class="fas fa-eye" data-toggle="modal" data-target="#editModal{{ $data->id }}">
                                    </button>
                                    <button type="button" class="btn btn-link p-0 openCommentModal"
                                        {{-- We now pass the user ID associated with this mahasiswa and the activity ID --}}
                                        data-mahasiswa-user-id="{{ $data->mahasiswa->user_id }}"
                                        data-id-kegiatan="{{ $data->id }}"
                                        data-toggle="modal"
                                        data-target="#commentModal">
                                        <i style="color: black" class="fas fa-comment"></i>
                                    </button>
                                </td>
                            </tr>

                            {{-- Edit Modal for each Kegiatan --}}
                            <div class="modal fade" id="editModal{{ $data->id }}" tabindex="-1" role="dialog">
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
                                                <input class="form-control" value="{{ $data->poin->posisi->nama_posisi }}"
                                                    disabled style="background-color: white;">
                                            </div>
                                            <div class="form-group">
                                                <label>Jenis Kegiatan</label>
                                                <input class="form-control"
                                                    value="{{ $data->poin->jenisKegiatan->jenis_kegiatan }}" disabled style="background-color: white;">
                                            </div>
                                            <div class="form-group">
                                                <label>Tingkat Kegiatan</label>
                                                <input class="form-control"
                                                    value="{{ $data->poin->tingkatKegiatan->tingkat_kegiatan }}" disabled style="background-color: white;">
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

{{-- REUSABLE COMMENT MODAL --}}
<div class="modal fade" id="commentModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form method="POST" action="{{ route('upapkk.kirimnotif') }}" id="formKomentar">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Komentar</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    {{-- THIS LINE: Change name="nim[]" to name="mahasiswa_id" --}}
                    <input type="hidden" name="mahasiswa_id" id="inputMahasiswaUserId">
                    <input type="hidden" name="id_kegiatan" id="inputIdKegiatan">
                    <div class="form-group">
                        <label>Isi Komentar</label>
                        <textarea class="form-control" name="komentar" id="inputKomentar" placeholder="Masukkan komentar..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning">Kirim</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
{{-- TOAST NOTIFIKASI --}}
<div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 9999">
    {{-- SUCCESS TOAST --}}
    <div id="successToast" class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body" id="successToastMessage">Berhasil</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>

    {{-- ERROR TOAST --}}
    <div id="errorToast" class="toast align-items-center text-white bg-danger border-0 mt-2" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body" id="errorToastMessage">Terjadi kesalahan</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>


{{-- SCRIPT --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    $('.openCommentModal').click(function () {
        const mahasiswaUserId = $(this).data('mahasiswa-user-id');
        const idKegiatan = $(this).data('id-kegiatan');

        $('#inputMahasiswaUserId').val(mahasiswaUserId);
        $('#inputIdKegiatan').val(idKegiatan);
        $('#inputKomentar').val('');
    });

    $('#formKomentar').submit(function (e) {
        e.preventDefault();

        const form = $(this);
        const formData = {
            mahasiswa_id: $('#inputMahasiswaUserId').val(),
            komentar: $('#inputKomentar').val(),
            id_kegiatan: $('#inputIdKegiatan').val(),
            _token: $('meta[name="csrf-token"]').attr('content')
        };

        $.ajax({
            url: form.attr('action'),
            method: form.attr('method'),
            data: formData,
            success: function (res) {
                $('#commentModal').modal('hide');
                showToast('success', res.message || 'Notifikasi berhasil dikirim');
            },
            error: function (err) {
                let msg = 'Gagal mengirim notifikasi.';
                if (err.responseJSON) {
                    if (err.responseJSON.errors) {
                        msg += '\n' + Object.values(err.responseJSON.errors).map(e => e.join(', ')).join('\n');
                    } else if (err.responseJSON.message) {
                        msg += '\n' + err.responseJSON.message;
                    }
                }
                showToast('error', msg);
                console.error(err);
            }
        });
    });

    function showToast(type, message) {
    if (type === 'success') {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: message || 'Notifikasi berhasil dikirim.',
            timer: 1500,
            showConfirmButton: false
        });
    } else if (type === 'error') {
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: message || 'Terjadi kesalahan.',
        });
    }
}

});
</script>
