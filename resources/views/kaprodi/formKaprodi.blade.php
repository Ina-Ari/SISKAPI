@extends('kaprodi.masterKaprodi')

@section('title', 'Formulir SKPI')

@section('content')
    <div class="card mx-2 my-2">
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
                <form id="form1">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Akreditasi Institusi *</label>
                                <select class="form-control select2" style="width: 100%;">
                                    <option selected="selected">--Pilih Akreditasi--</option>
                                    <option>Unggul</option>
                                    <option>Baik Sekali</option>
                                    <option>Baik</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Program Studi *</label>
                                <select class="form-control select2" style="width: 100%;">
                                    <option selected="selected">--Pilih Prodi--</option>
                                    <option>AJK</option>
                                    <option>MI</option>
                                    <option>TRPL</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Jenis & Program Pendidikan *</label>
                                <select class="form-control select2" style="width: 100%;">
                                    <option selected="selected">--Pilih Prodi--</option>
                                    <option>Vokasi & Diploma 2</option>
                                    <option>Vokasi & Diploma 3</option>
                                    <option>Vokasi & Diploma 4</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="gelar" class="form-label">Gelar *</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="kualifikasiKKNI" class="form-label">Jenjang Kualifikasi Sesuai KKNI *</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="persyaratan" class="form-label">Persyaratan Penerimaan *</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="bahasa" class="form-label">Bahasa Pengantar Kuliah*</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="lamaStudi" class="form-label">Lama Studi Reguler *</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Institution's Accrediation *</label>
                                <select class="form-control select2" style="width: 100%;">
                                    <option selected="selected">--Choose Accrediation--</option>
                                    <option>Superior</option>
                                    <option>Very Good</option>
                                    <option>Good</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Study Program *</label>
                                <select class="form-control select2" style="width: 100%;">
                                    <option selected="selected">--Choose Study Program--</option>
                                    <option>AJK</option>
                                    <option>MI</option>
                                    <option>TRPL</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Type & Level of Education *</label>
                                <select class="form-control select2" style="width: 100%;">
                                    <option selected="selected">--Choose level & Type of Education--</option>
                                    <option>Vocation & Associate Degree</option>
                                    <option>Vocation & Bachelor Degree</option>
                                    <option>Vocation & Bachelor Degree</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="degree" class="form-label">Academyc Degree *</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="KKNILevel" class="form-label"> Level in the Indonesian Qualification Framework
                                    *</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="adminission" class="form-label">Adminission Requirements *</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="language" class="form-label">Language of Instruction *</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="lengthOfStudy" class="form-label">Reguler Length of Study *</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="btn btn-primary px-4">Simpan</button>
                    </div>
                </form>

                <form id="form2">
                    <div class="row mb-2">
                        <div class="col-6 font-weight-bold">Sikap *</div>
                        <div class="col-6 font-weight-bold">Attitude *</div>
                    </div>
                    <div id="statement-container1">
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <input type="text" name="sikap[]" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="attitude[]" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <button type="button" class="btn" style="background-color: #9CC0FA;" onclick="tambahPernyataan1()">+ Tambah
                            Pernyataan</button>
                    </div>

                    <div class="row mb-2">
                        <div class="col-6 font-weight-bold">Penguasaan Pengetahuan *</div>
                        <div class="col-6 font-weight-bold">Knowledge *</div>
                    </div>
                    <div id="statement-container2">
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <input type="text" name="pengetahuan[]" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="knowledge[]" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <button type="button" class="btn" style="background-color: #9CC0FA;" onclick="tambahPernyataan2()">+ Tambah
                            Pernyataan</button>
                    </div>

                    <div class="row mb-2">
                        <div class="col-6 font-weight-bold">Keterampilan Umum *</div>
                        <div class="col-6 font-weight-bold">General Skills *</div>
                    </div>
                    <div id="statement-container3">
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <input type="text" name="ketUmum[]" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="genSkills[]" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <button type="button" class="btn" style="background-color: #9CC0FA;" onclick="tambahPernyataan3()">+ Tambah
                            Pernyataan</button>
                    </div>

                    <div class="row mb-2">
                        <div class="col-6 font-weight-bold">Keterampilan Khusus *</div>
                        <div class="col-6 font-weight-bold">Special Skills *</div>
                    </div>
                    <div id="statement-container4">
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <input type="text" name="ketKhusus[]" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="specSkills[]" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <button type="button" class="btn" style="background-color: #9CC0FA;" onclick="tambahPernyataan4()">+ Tambah
                            Pernyataan</button>
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
