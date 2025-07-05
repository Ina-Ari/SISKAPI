@extends('mhs.masterMhs')

@section('title', 'Profil Mahasiswa')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row" style="margin-top:10px;">
                <div class="col-lg-12">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                    style="width:200px; height:200px; object-fit:cover;"
                                    src="{{ $user->picture ? asset('../storage/' . $user->picture) : asset('../../dist/img/user4-128x128.jpg') }}"
                                    alt="User profile picture">
                            </div>

                            <h2 class="text-center" style="font-size: 2rem; margin-top:5px;">{{ $user->nama }}</h2>

                            <div class="card-footer" style="font-size: 1.5rem;">
                                <div class="row">
                                    <div class="col-sm-6 border-right">
                                        <div class="description-block">
                                            <h4><b>{{ $mahasiswa->nim }}</b></h4>
                                            <span class="description-text">NIM</span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-6 border-right">
                                        <div class="description-block">
                                            <h4><b>
                                                    @if (!empty($mahasiswa->telepon))
                                                        <p>{{ $mahasiswa->telepon }}</p>
                                                    @else
                                                        -
                                                    @endif
                                                </b></h4>
                                            <span class="description-text">Nomor Telepon</span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                    <!-- /.col -->
                                    {{-- <div class="col-sm-4">
                                        <div class="description-block">
                                        <h4><b>
                                            @if (!empty($mahasiswa->kelas))
                                            <p>{{ $mahasiswa->kelas }}</p>
                                            @else
                                                -
                                            @endif
                                        </b></h4>
                                        <span class="description-text">Kelas</span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div> --}}
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->
                            </div>
                            <a class="btn btn-primary btn-block" data-toggle="modal"
                                data-target="#formEditMhs"><b>EDIT</b></a>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- Widget: user widget style 2 -->
                    <div class="card card-widget widget-user-2">
                        <h2 style="padding: 20px;"><b>Informasi Detail</b></h2>
                        <div class="card-footer p-0">
                            <ul class="nav flex-column" style="font-size: 1.4rem;">
                                <li class="nav-item nav-link">
                                    Email <span class="float-right">{{ $user->email }}</span>
                                </li>
                                <li class="nav-item nav-link">
                                    Jurusan <span class="float-right">{{ $mahasiswa->prodi->jurusan->nama_jurusan }}</span>
                                </li>
                                <li class="nav-item nav-link">
                                    Program Studi <span class="float-right">{{ $mahasiswa->prodi->jenjang }}
                                        {{ $mahasiswa->prodi->nama_prodi }}</span>
                                </li>
                                {{-- <li class="nav-item nav-link">
                    Alamat
                    <span class="float-right">
                      @if (!empty($mahasiswa->alamat))
                        {{ $mahasiswa->alamat }}
                      @else
                          -
                      @endif
                    </span>
                  </li> --}}
                                <li class="nav-item nav-link">
                                    @if ($mahasiswa->prodi->jenjang == 'D4' && $totalPoin >= 28)
                                        Status Poin <span class="float-right badge bg-primary">Memenuhi Syarat</span>
                                    @elseif ($mahasiswa->prodi->jenjang == 'D3' && $totalPoin >= 24)
                                        Status Poin <span class="float-right badge bg-danger">Memenuhi Syarat</span>
                                    @else
                                        Status Poin <span class="float-right badge bg-danger">Belum Memenuhi Syarat</span>
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- /.widget-user -->
                </div>
            </div>
    </section>

    {{-- Modal Edit --}}
    <div class="modal fade" id="formEditMhs" tabindex="-1" aria-labelledby="formEditMhsLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('mahasiswa.updateProfile', $mahasiswa->user_id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h3 class="modal-title" id="formEditMhsLabel">Edit Data Mahasiswa</h3>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="picture" class="form-label">Foto Profil</label>
                            <input type="file" class="form-control" id="picture" name="picture">
                            @if ($user->picture)
                                <img id="fotoProfilPreview"
                                    src="{{ $user->picture ? asset('storage/' . $user->picture) : asset('../../dist/img/user4-128x128.jpg') }}"
                                    alt="Foto Profil" class="img-thumbnail mt-2" width="500">
                            @else
                                <img id="fotoProfilPreview" src="{{ asset('../../dist/img/user4-128x128.jpg') }}"
                                    alt="Foto Profil" class="img-thumbnail mt-2" width="500">
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama"
                                value="{{ $user->nama }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="nim" class="form-label">NIM</label>
                            <input type="text" id="nim" class="form-control" value="{{ $mahasiswa->nim }}"
                                readonly style="background-color: #ffffff; border: 1px solid #ccc; color: #495057;">
                        </div>
                        {{-- <div class="mb-3">
                            <label for="kelas" class="form-label">Kelas</label>
                            <input type="text" class="form-control" id="kelas" name="kelas"
                                value="{{ $mahasiswa->kelas }}" required>
                        </div> --}}
                        <div class="mb-3">
                            <label for="telepon" class="form-label">No Telepon</label>
                            <input type="text" class="form-control" id="telepon" name="telepon"
                                value="{{ $mahasiswa->telepon }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ $user->email }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="jenjang_pendidikan" class="form-label">Jenjang Pendidikan</label>
                            <input type="text" id="jenjang_pendidikan" class="form-control"
                                value="{{ $mahasiswa->prodi->jenjang }}" readonly
                                style="background-color: #ffffff; border: 1px solid #ccc; color: #495057;">
                        </div>
                        <div class="mb-3">
                            <label for="kode_jurusan" class="form-label">Jurusan</label>
                            <div class="mb-3">
                                <input type="text" id="jurusan" class="form-control"
                                    value="{{ $mahasiswa->prodi->jurusan->nama_jurusan }}" readonly
                                    style="background-color: #ffffff; border: 1px solid #ccc; color: #495057;">
                            </div>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="kode_prodi" class="form-label">Program Studi</label>
                            <div class="mb-3">
                                <input type="text" id="prodi" class="form-control"
                                    value="{{ $mahasiswa->prodi->nama_prodi }}" readonly
                                    style="background-color: #ffffff; border: 1px solid #ccc; color: #495057;">
                            </div>

                        </div>
                        {{-- <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="3">{{ $mahasiswa->alamat }}</textarea>
                        </div> --}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // JavaScript untuk preview foto secara realtime
        document.getElementById('picture').addEventListener('change', function(event) {
            var reader = new FileReader();

            reader.onload = function(e) {
                // Ubah src gambar dengan hasil load
                document.getElementById('fotoProfilPreview').src = e.target.result;
            };

            // Ambil file yang dipilih
            var file = event.target.files[0];

            if (file) {
                reader.readAsDataURL(file); // Membaca file sebagai URL data
            }
        });
    </script>
@endsection
