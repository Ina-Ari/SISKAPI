@extends('kaprodi.masterKaprodi')

@section('title', 'Formulir SKPI')

@section('content')
    <div class="card mx-2 my-2">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="card-body">
            <nav class="nav nav-pills nav-fill mb-4" id="customTabs">
                <a class="nav-link text-center custom-tab" href="#" onclick="setActiveTab(event, 'form1')">
                    <span class="px-4 py-2 d-inline-block rounded-pill">
                        Identitas Institusi & Prodi
                    </span>
                </a>
                <a class="nav-link text-center custom-tab" href="#" onclick="setActiveTab(event, 'form2')">
                    <span class="px-4 py-2 d-inline-block rounded-pill">
                        Kualifikasi & Kompetensi Akademik Lulusan
                    </span>
                </a>
            </nav>
            <div id="formContainer">
                <form id="form1" method="POST" action="{{ route('form.storeSkpi1') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Akreditasi Institusi <span style="font-weight: 200; font-style:italic;"> (Versi Bahasa Indonesia) </span>*</label>
                                <select name="akreditasi_institusi" class="form-control">
                                    <option selected="selected">-- Pilih Akreditasi  --</option>
                                    <option value="unggul">Unggul</option>
                                    <option value="baik sekali">Baik Sekali</option>
                                    <option value="baik">Baik</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Program Studi <span style="font-weight: 200; font-style:italic;"> (Versi Bahasa Indonesia) </span>*</label>
                                <select name="kode_prodi" class="form-control">
                                    <option value="">-- Pilih Prodi --</option>
                                    @foreach ($prodi as $item)
                                        <option value="{{ $item->kode_prodi }}">{{ $item->nama_prodi }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Jenis & Program Pendidikan <span style="font-weight: 200; font-style:italic;"> (Versi Bahasa Indonesia) </span>*</label>
                                <select name="jenis_pendidikan" class="form-control">
                                    <option selected="selected">-- Pilih Jenis & Program Pendidikan --</option>
                                    <option value="vokasi & d2">Vokasi & Diploma 2</option>
                                    <option value="vokasi & d3">Vokasi & Diploma 3</option>
                                    <option value="vokasi & d4">Vokasi & Diploma 4</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="gelar" class="form-label">Gelar <span style="font-weight: 200; font-style:italic;"> (Versi Bahasa Indonesia) </span>*</label>
                                <input type="text" class="form-control" name="gelar">
                                @error('gelar')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="kualifikasi_kkni" class="form-label">Jenjang Kualifikasi Sesuai KKNI <span style="font-weight: 200; font-style:italic;"> (Versi Bahasa Indonesia) </span>*</label>
                                <input type="text" class="form-control" name="kualifikasi_kkni">
                            </div>
                            <div class="mb-3">
                                <label for="persyaratan_penerimaan" class="form-label">Persyaratan Penerimaan <span style="font-weight: 200; font-style:italic;"> (Versi Bahasa Indonesia) </span>*</label>
                                <input type="text" class="form-control" name="persyaratan_penerimaan">
                            </div>
                            <div class="mb-3">
                                <label for="bahasa_pengantar" class="form-label">Bahasa Pengantar Kuliah <span style="font-weight: 200; font-style:italic;"> (Versi Bahasa Indonesia) </span>*</label>
                                <input type="text" class="form-control" name="bahasa_pengantar">
                            </div>
                            <div class="mb-3">
                                <label for="lama_studi" class="form-label">Lama Studi Reguler <span style="font-weight: 200; font-style:italic;"> (Versi Bahasa Indonesia) </span>*</label>
                                <input type="text" class="form-control" name="lama_studi">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Institution's Accrediation <span style="font-weight: 200; font-style:italic;"> (English Version) </span>*</label>
                                <select name="institution_acc" class="form-control">
                                    <option selected="selected">-- Choose Accrediation --</option>
                                    <option value="superior">Superior</option>
                                    <option value="very good">Very Good</option>
                                    <option value="good">Good</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Study Program <span style="font-weight: 200; font-style:italic;"> (English Version) </span>*</label>
                                <select name="study_program" class="form-control">
                                    <option selected="selected">-- Choose Study Program --</option>
                                    <option value="AJK">Computer Network Administration</option>
                                    <option value="MI">Informatics Management</option>
                                    <option value="TRPL">Software Engineering Technology</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Type & Level of Education <span style="font-weight: 200; font-style:italic;"> (English Version) </span>*</label>
                                <select name="education_type" class="form-control">
                                    <option selected="selected">-- Choose level & Type of Education --</option>
                                    <option value="vocation & d2">Vocation & Associate Degree</option>
                                    <option value="vocation & d3">Vocation & Bachelor Degree</option>
                                    <option value="vocation & d4">Vocation & Bachelor Degree</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="degree" class="form-label">Academyc Degree <span style="font-weight: 200; font-style:italic;"> (English Version) </span>*</label>
                                <input type="text" class="form-control" name="degree">
                            </div>
                            <div class="mb-3">
                                <label for="kkni_level" class="form-label"> Level in the Indonesian Qualification Framework <span style="font-weight: 200; font-style:italic;"> (English Version) </span>*</label>
                                <input type="text" class="form-control" name="kkni_level">
                            </div>
                            <div class="mb-3">
                                <label for="adminission_requirement" class="form-label">Adminission Requirements <span style="font-weight: 200; font-style:italic;"> (English Version) </span>*</label>
                                <input type="text" class="form-control" name="adminission_requirement">
                            </div>
                            <div class="mb-3">
                                <label for="instruction_language" class="form-label">Language of Instruction <span style="font-weight: 200; font-style:italic;"> (English Version) </span>*</label>
                                <input type="text" class="form-control" name="instruction_language">
                            </div>
                            <div class="mb-3">
                                <label for="length_study" class="form-label">Reguler Length of Study <span style="font-weight: 200; font-style:italic;"> (English Version) </span>*</label>
                                <input type="text" class="form-control" name="length_study">
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="btn btn-primary px-4">Simpan</button>
                    </div>
                </form>

                <form id="form2" method="POST" action="{{ route('form.storeSkpi2') }}">
                    @csrf
                    <div class="row mb-2 mx-2">
                        <div class="col-6 font-weight-bold">Sikap <span style="font-weight: 200; font-style:italic;"> (Versi Bahasa Indonesia) </span>*</div>
                        <div class="col-6 font-weight-bold">Attitude <span style="font-weight: 200; font-style:italic;"> (English Version) </span>*</div>
                    </div>
                    <div id="statement-container1">
                        <div class="row mb-2 mx-2 align-items-center">
                            <div class="" >
                                <input type="checkbox" class="form-check-input mt-1">
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="sikap[]" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="attitude[]" class="form-control">
                            </div>
                        </div>
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
                        <div class="row mb-2 mx-2 align-items-center">
                            <div class="" >
                                <input type="checkbox" class="form-check-input mt-1">
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="penguasaan_pengetahuan[]" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="knowledge[]" class="form-control">
                            </div>
                        </div>
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
                        <div class="row mb-2 mx-2 align-items-center">
                            <div class="" >
                                <input type="checkbox" class="form-check-input mt-1">
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="keterampilan_umum[]" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="general_skills[]" class="form-control">
                            </div>
                        </div>
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
                        <div class="row mb-2 mx-2 align-items-center">
                            <div class="" >
                                <input type="checkbox" class="form-check-input mt-1">
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="keterampilan_khusus[]" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="special_skills[]" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 mx-3">
                        <button type="button" class="btn" style="background-color: #9CC0FA;" onclick="tambahPernyataan('statement-container4', 'keterampilan_khusus', 'special_skills')">+ Tambah
                            Pernyataan</button>
                        <button type="button" class="btn btn-danger" onclick="hapus('statement-container4')">Hapus</button>
                    </div>

                    <!-- Tombol Simpan -->
                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="btn btn-primary px-4">Simpan</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
