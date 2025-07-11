@extends('kaprodi.masterKaprodi')

@section('title', 'Formulir SKPI')

@section('content')
    {{-- Header --}}
    <section class="m-4 d-flex flex-column flex-lg-row align-items-center justify-content-between">
        <h1 class="text-bold text-primary drop">Formulir SKPI</h1>
        <div class="d-flex items-center" style="gap: 1rem">
            <button type="button" class="btn btn-primary py-2 px-4" data-toggle="modal" data-target="#templatePreview">
                <i class="fa fa-eye mr-2"></i>
                Lihat Template SKPI
            </button>
            <button type="button" class="btn btn-success py-2 px-4" data-toggle="modal" data-target="#templateUpload">
                <i class="fa fa-upload mr-2"></i>
                Upload Template SKPI
            </button>
        </div>
    </section>

    <div class="card m-4">
        <div class="card-body">
            <nav class="nav nav-pills nav-fill mb-4" id="customTabs">
                <a class="nav-link text-center custom-tab nav-pill-tab" href="#" onclick="setActiveTab(event, 'form1')">
                    <span class="px-4 py-2 d-inline-block rounded-pill">
                        Identitas Institusi & Prodi
                    </span>
                </a>
                <a class="nav-link text-center custom-tab nav-pill-tab" href="#" onclick="setActiveTab(event, 'form2')">
                    <span class="px-4 py-2 d-inline-block rounded-pill">
                        Kualifikasi & Kompetensi Akademik Lulusan
                    </span>
                </a>
            </nav>
            <div id="formContainer">
                <form id="form1" method="POST" action="{{ route('kaprodi.storeSkpi1') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Akreditasi Institusi <span style="font-weight: 200; font-style:italic;"> (Versi Bahasa Indonesia) </span>*</label>
                                <select name="akreditasi_institusi" class="form-control">
                                    <option selected="selected">-- Pilih Akreditasi  --</option>
                                    <option value="unggul" {{ old('akreditasi_institusi', $skpi->akreditasi_institusi ?? '') == 'unggul' ? 'selected' : '' }}>Unggul</option>
                                    <option value="baik sekali" {{ old('akreditasi_institusi', $skpi->akreditasi_institusi ?? '') == 'baik sekali' ? 'selected' : '' }}>Baik Sekali</option>
                                    <option value="baik" {{ old('akreditasi_institusi', $skpi->akreditasi_institusi ?? '') == 'baik' ? 'selected' : '' }}>Baik</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Program Studi <span style="font-weight: 200; font-style:italic;"> (Versi Bahasa Indonesia) </span>*</label>
                                <input type="text" class="form-control" name="kualifikasi_kkni" value="{{ $kaprodi->prodi->nama_prodi }}" disabled>
                            </div>
                            <div class="form-group">
                                <label>Jenis & Program Pendidikan <span style="font-weight: 200; font-style:italic;"> (Versi Bahasa Indonesia) </span>*</label>
                                <select name="jenis_pendidikan" class="form-control">
                                    <option selected="selected">-- Pilih Jenis & Program Pendidikan --</option>
                                    <option value="vokasi & d2" {{ old('jenis_pendidikan', $skpi->jenis_pendidikan ?? '') == 'vokasi & d2' ? 'selected' : '' }}>Vokasi & Diploma 2</option>
                                    <option value="vokasi & d3" {{ old('jenis_pendidikan', $skpi->jenis_pendidikan ?? '') == 'vokasi & d3' ? 'selected' : '' }}>Vokasi & Diploma 3</option>
                                    <option value="vokasi & d4" {{ old('jenis_pendidikan', $skpi->jenis_pendidikan ?? '') == 'vokasi & d4' ? 'selected' : '' }}>Vokasi & Diploma 4</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="gelar" class="form-label">Gelar <span style="font-weight: 200; font-style:italic;"> (Versi Bahasa Indonesia) </span>*</label>
                                <input type="text" name="gelar" class="form-control" value="{{ old('gelar', $skpi->gelar ?? '') }}">
                            </div>
                            <div class="mb-3">
                                <label for="kualifikasi_kkni" class="form-label">Jenjang Kualifikasi Sesuai KKNI <span style="font-weight: 200; font-style:italic;"> (Versi Bahasa Indonesia) </span>*</label>
                                <input type="text" class="form-control" name="kualifikasi_kkni" value="{{ old('kualifikasi_kkni', $skpi->kualifikasi_kkni ?? '') }}">
                            </div>
                            <div class="mb-3">
                                <label for="persyaratan_penerimaan" class="form-label">Persyaratan Penerimaan <span style="font-weight: 200; font-style:italic;"> (Versi Bahasa Indonesia) </span>*</label>
                                <input type="text" class="form-control" name="persyaratan_penerimaan" value="{{ old('persyaratan_penerimaan', $skpi->persyaratan_penerimaan ?? '') }}">
                            </div>
                            <div class="mb-3">
                                <label for="bahasa_pengantar" class="form-label">Bahasa Pengantar Kuliah <span style="font-weight: 200; font-style:italic;"> (Versi Bahasa Indonesia) </span>*</label>
                                <input type="text" class="form-control" name="bahasa_pengantar" value="{{ old('bahasa_pengantar', $skpi->bahasa_pengantar ?? '') }}">
                            </div>
                            <div class="mb-3">
                                <label for="lama_studi" class="form-label">Lama Studi Reguler <span style="font-weight: 200; font-style:italic;"> (Versi Bahasa Indonesia) </span>*</label>
                                <input type="text" class="form-control" name="lama_studi" value="{{ old('lama_studi', $skpi->lama_studi ?? '') }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Institution's Accrediation <span style="font-weight: 200; font-style:italic;"> (English Version) </span>*</label>
                                <select name="institution_acc" class="form-control">
                                    <option selected="selected">-- Choose Accrediation --</option>
                                    <option value="superior" {{ old('institution_acc', $skpi->institution_acc ?? '') == 'superior' ? 'selected' : '' }}>Superior</option>
                                    <option value="very good" {{ old('institution_acc', $skpi->institution_acc ?? '') == 'very good' ? 'selected' : '' }}>Very Good</option>
                                    <option value="good" {{ old('institution_acc', $skpi->institution_acc ?? '') == 'good' ? 'selected' : '' }}>Good</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Study Program <span style="font-weight: 200; font-style:italic;"> (English Version) </span>*</label>
                                    <input type="text" class="form-control" name="study_program" value="{{ $kaprodi->prodi->prodi_name }}" disabled>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Type & Level of Education <span style="font-weight: 200; font-style:italic;"> (English Version) </span>*</label>
                                <select name="education_type" class="form-control">
                                    <option selected="selected">-- Choose level & Type of Education --</option>
                                    <option value="vocation & d2" {{ old('education_type', $skpi->education_type ?? '') == 'vocation & d2' ? 'selected' : '' }}>Vocation & Associate Degree</option>
                                    <option value="vocation & d3" {{ old('education_type', $skpi->education_type ?? '') == 'vocation & d3' ? 'selected' : '' }}>Vocation & Bachelor Degree</option>
                                    <option value="vocation & d4" {{ old('education_type', $skpi->education_type ?? '') == 'vocation & d4' ? 'selected' : '' }}>Vocation & Bachelor Degree</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="degree" class="form-label">Academyc Degree <span style="font-weight: 200; font-style:italic;"> (English Version) </span>*</label>
                                <input type="text" class="form-control" name="degree" value="{{ old('degree', $skpi->degree ?? '') }}">
                            </div>
                            <div class="mb-3">
                                <label for="kkni_level" class="form-label"> Level in the Indonesian Qualification Framework <span style="font-weight: 200; font-style:italic;"> (English Version) </span>*</label>
                                <input type="text" class="form-control" name="kkni_level" value="{{ old('kkni_level', $skpi->kkni_level ?? '') }}">
                            </div>
                            <div class="mb-3">
                                <label for="adminission_requirement" class="form-label">Adminission Requirements <span style="font-weight: 200; font-style:italic;"> (English Version) </span>*</label>
                                <input type="text" class="form-control" name="adminission_requirement" value="{{ old('adminission_requirement', $skpi->adminission_requirement ?? '') }}">
                            </div>
                            <div class="mb-3">
                                <label for="instruction_language" class="form-label">Language of Instruction <span style="font-weight: 200; font-style:italic;"> (English Version) </span>*</label>
                                <input type="text" class="form-control" name="instruction_language" value="{{ old('instruction_language', $skpi->instruction_language ?? '') }}">
                            </div>
                            <div class="mb-3">
                                <label for="length_study" class="form-label">Reguler Length of Study <span style="font-weight: 200; font-style:italic;"> (English Version) </span>*</label>
                                <input type="text" class="form-control" name="length_study" value="{{ old('length_study', $skpi->length_study ?? '') }}">
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <button id="btn-simpan1" type="submit" class="btn btn-primary px-4">Simpan</button>
                    </div>
                </form>

                <form id="form2" method="POST" action="{{ route('kaprodi.storeSkpi2') }}" style="display: none;">
                    @csrf
                    <div class="row mb-2 mx-2">
                        <div class="col-6 font-weight-bold">Sikap <span style="font-weight: 200; font-style:italic;"> (Versi Bahasa Indonesia) </span>*</div>
                        <div class="col-6 font-weight-bold">Attitude <span style="font-weight: 200; font-style:italic;"> (English Version) </span>*</div>
                    </div>
                    <div id="statement-container1">
                        @foreach (($sikap ?? []) as $index => $sikapItem)
                            <div class="row mb-2 mx-2 align-items-center">
                                <div>
                                    <input type="checkbox" class="form-check-input mt-1">
                                </div>
                                <div class="col-md-6 mb-2">
                                    <textarea name="sikap[]" rows="2" class="form-control auto-resize">{{ $sikapItem ?? ''}}</textarea >
                                </div>
                                <div class="col-md-6 mb-2">
                                    <textarea name="attitude[]" rows="2" class="form-control auto-resize">{{ $attitude[$index] ?? '' }}</textarea >
                                </div>
                            </div>
                        @endforeach

                    </div>
                    <div class="mb-3 mx-3">
                        <button type="button" class="btn" style="background-color: #9CC0FA;" onclick="tambahPernyataan('statement-container1', 'sikap', 'attitude')">+ Tambah
                            Pernyataan</button>
                        <button type="button" class="btn btn-danger" onclick="hapus('statement-container1')">Hapus</button>
                    </div>

                    <div class="row mb-2 mx-2">
                        <div class="col-6 font-weight-bold">Penguasaan Pengetahuan <span style="font-weight: 200; font-style:italic;"> (Versi Bahasa Indonesia) </span>*</div>
                        <div class="col-6 font-weight-bold">Knowledge <span style="font-weight: 200; font-style:italic;"> (English Version) </span>*</div>
                    </div>
                    <div id="statement-container2">
                        @foreach (($penguasaan_pengetahuan ?? []) as $index => $penguasaan_pengetahuanItem)
                            <div class="row mb-2 mx-2 align-items-center">
                                <div>
                                    <input type="checkbox" class="form-check-input mt-1">
                                </div>
                                <div class="col-md-6 mb-2">
                                    <textarea name="penguasaan_pengetahuan[]" rows="2" class="form-control auto-resize">{{$penguasaan_pengetahuanItem ?? ''}}</textarea >
                                </div>
                                <div class="col-md-6 mb-2">
                                    <textarea name="knowledge[]" rows="2" class="form-control auto-resize">{{ $knowledge[$index] ?? '' }}</textarea >
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mb-3 mx-3">
                        <button type="button" class="btn" style="background-color: #9CC0FA;" onclick="tambahPernyataan('statement-container2', 'penguasaan_pengetahuan', 'knowledge')">+ Tambah
                            Pernyataan</button>
                        <button type="button" class="btn btn-danger" onclick="hapus('statement-container2')">Hapus</button>
                    </div>

                    <div class="row mb-2 mx-2">
                        <div class="col-6 font-weight-bold">Keterampilan Umum <span style="font-weight: 200; font-style:italic;"> (Versi Bahasa Indonesia) </span>*</div>
                        <div class="col-6 font-weight-bold">General Skills <span style="font-weight: 200; font-style:italic;"> (English Version) </span>*</div>
                    </div>
                    <div id="statement-container3">
                        @foreach (($keterampilan_umum ?? []) as $index => $keterampilan_umumItem)
                            <div class="row mb-2 mx-2 align-items-center">
                                <div>
                                    <input type="checkbox" class="form-check-input mt-1">
                                </div>
                                <div class="col-md-6 mb-2">
                                    <textarea name="keterampilan_umum[]" rows="2" class="form-control auto-resize">{{ $keterampilan_umumItem ?? ''}}</textarea >
                                </div>
                                <div class="col-md-6 mb-2">
                                    <textarea name="general_skills[]" rows="2" class="form-control auto-resize">{{ $general_skills[$index] ?? '' }}</textarea >
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mb-3 mx-3">
                        <button type="button" class="btn" style="background-color: #9CC0FA;" onclick="tambahPernyataan('statement-container3', 'keterampilan_umum', 'general_skills')">+ Tambah
                            Pernyataan</button>
                        <button type="button" class="btn btn-danger" onclick="hapus('statement-container3')">Hapus</button>
                    </div>

                    <div class="row mb-2 mx-2">
                        <div class="col-6 font-weight-bold">Keterampilan Khusus <span style="font-weight: 200; font-style:italic;"> (Versi Bahasa Indonesia) </span>*</div>
                        <div class="col-6 font-weight-bold">Special Skills <span style="font-weight: 200; font-style:italic;"> (English Version) </span>*</div>
                    </div>
                    <div id="statement-container4">
                        @foreach (($keterampilan_khusus ?? []) as $index => $keterampilan_khususItem)
                            <div class="row mb-2 mx-2 align-items-center">
                                <div>
                                    <input type="checkbox" class="form-check-input mt-1">
                                </div>
                                <div class="col-md-6 mb-2">
                                    <textarea name="keterampilan_khusus[]" rows="2" class="form-control auto-resize">{{ $keterampilan_khususItem ?? ''}}</textarea >
                                </div>
                                <div class="col-md-6 mb-2">
                                    <textarea name="special_skills[]" rows="2" class="form-control auto-resize">{{ $special_skills[$index] ?? '' }}</textarea >
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mb-3 mx-3">
                        <button type="button" class="btn" style="background-color: #9CC0FA;" onclick="tambahPernyataan('statement-container4', 'keterampilan_khusus', 'special_skills')">+ Tambah
                            Pernyataan</button>
                        <button type="button" class="btn btn-danger" onclick="hapus('statement-container4')">Hapus</button>
                    </div>

                    <!-- Tombol Simpan -->
                    <div class="d-flex justify-content-end mt-4">
                        <button id="btn-simpan2" type="submit" class="btn btn-primary px-4">Simpan</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    {{-- Modal Peringatan --}}
    <div class="modal fade" id="unsavedModal" tabindex="-1" aria-labelledby="unsavedModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered"> {{-- Tengah layar --}}
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="unsavedModalLabel">Peringatan</h5>
            </div>
            <div class="modal-body">
                Anda memiliki perubahan yang belum disimpan. Apakah Anda ingin menyimpan sebelum meninggalkan halaman?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="confirmSave">Simpan</button>
            </div>
            </div>
        </div>
    </div>

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
                        href="{{ asset("storage/$templateFullPath") . '?t=' . now() }}" target="_blank">
                        See PDF
                    </a>
                    <embed id="pdfViewer" src="{{ asset("storage/$templateFullPath") . '?t=' . now() }}#toolbar=0" width="100%" height="100%"></embed>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Upload Template --}}
    <div class="modal fade" id="templateUpload" tabindex="-1" aria-labelledby="templateUploadLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header align-items-center py-2">
                    <h3 class="modal-title font-weight-bold text-success" id="templateUploadLabel">UploadTemplate SKPI</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body d-flex justify-content-center">
                    <form action="{{ route('kaprodi.skpi.create.template') }}" method="POST" enctype="multipart/form-data" class="d-flex flex-column" style="gap: 1rem;">
                        @csrf
                        <label for="template" class="block">
                            Upload Template (.docx)
                            <input type="file" accept=".docx" name="template" id="template" class="form-control">
                        </label>
                        <label for="namaKajur" class="block">
                            Nama Ketua Jurusan
                            <input type="text" name="nama_kajur" id="namaKajur" class="form-control">
                        </label>
                        <label for="nipKajur" class="block">
                            NIP Ketua Jurusan
                            <input type="text" name="nip_kajur" id="nipKajur" class="form-control">
                        </label>
                        <button type="submit" class="btn btn-success">
                            Upload
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
