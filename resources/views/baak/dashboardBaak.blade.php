@extends('baak.masterBaak')

@section('title', 'Dashboard BAAK')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <h4 class="m-0 font-weight-bold text-primary">Dashboard</h4>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">

            <!-- Welcome Card -->
            <div class="card mb-4 position-relative" id="welcome-card"
                style="background: linear-gradient(90deg, #4150B5, #4A67D6); color: white;">
                <div class="card-body">
                    <button class="close text-white position-absolute"
                        onclick="document.getElementById('welcome-card').remove()"
                        style="top: 10px; right: 15px; background: none; border: none; font-size: 20px;">
                        &times;
                    </button>
                    <h5 class="text-white">Selamat Datang, <strong>Admin BAAK</strong></h5>
                    <p class="text-white mb-0">Pantau pengajuan SKPI mahasiswa pada dashboard ini.</p>
                </div>
            </div>

            <div class="row">
                <!-- Box 1 -->
                <div class="col-lg-3 col-6 mb-3">
                    <div class="small-box d-flex flex-column align-items-start justify-content-center text-start px-4 py-4 gap-2"
                        style="background-color: #3B82F6; color: white; border-radius: 0.25rem; height: 150px;">
                        <i class="fas fa-file-alt fa-2x"></i>
                        <h3 class="mt-2 mb-0">582</h3>
                        <p style="font-size: 13px; margin: 0;">Total Pengajuan SKPI</p>
                    </div>
                </div>


                <!-- Box 2 -->
                <div class="col-lg-3 col-6 mb-3">
                    <div class="small-box d-flex flex-column align-items-start justify-content-center text-start px-4 py-4 gap-2"
                        style="background-color: #EAB308; color: white; border-radius: 0.25rem; height: 150px;">
                        <i class="fas fa-sync-alt fa-2x mb-2"></i>
                        <h3 class="mt-2 mb-0">320</h3>
                        <p style="font-size: 13px; margin: 0;">Proses Verifikasi</p>
                    </div>
                </div>

                <!-- Box 3 -->
                <div class="col-lg-3 col-6 mb-3">
                    <div class="small-box d-flex flex-column align-items-start justify-content-center text-start px-4 py-4 gap-2"
                        style="background-color: #059669; color: white; border-radius: 0.25rem; height: 150px;">
                        <i class="fas fa-check-circle fa-2x mb-2"></i>
                        <h3 class="mt-2 mb-0">53</h3>
                        <p style="font-size: 13px; margin: 0;">Telah Diverifikasi</p>
                    </div>
                </div>

                <!-- Box 4 -->
                <div class="col-lg-3 col-6 mb-3">
                    <div class="small-box d-flex flex-column align-items-start justify-content-center text-start px-4 py-4 gap-2"
                        style="background-color: #BA2532; color: white; border-radius: 0.25rem; height: 150px;">
                        <i class="fas fa-exclamation-triangle fa-2x mb-2"></i>
                        <h3 class="mt-2 mb-0">48</h3>
                        <p style="font-size: 13px; margin: 0;">Pengajuan Direvisi</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-7 connectedSortable">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Statistik Pengajuan SKPI</h3>
                        </div>
                        <div class="card-body">
                            <div id="skpi-chart" style="min-height: 300px;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"
                        style="margin-bottom: 20px;">
                        Tambah Pengajuan SKPI
                    </button>
                </div>
            </div>
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Pengajuan SKPI</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Tabs Navigation -->
                        <nav class="nav nav-fill mb-4" id="modalTabs">
                            <a class="nav-link text-center custom-tab nav-pill-tab active" href="#"
                                onclick="setActiveModalTab(event, 'modalForm1')">
                                <span class="px-4 py-2 d-inline-block rounded-pill">
                                    Identitas Pemegang SKPI
                                </span>
                            </a>
                            <a class="nav-link text-center custom-tab nav-pill-tab" href="#"
                                onclick="setActiveModalTab(event, 'modalForm2')">
                                <span class="px-4 py-2 d-inline-block rounded-pill">
                                    Identitas Institusi & Prodi
                                </span>
                            </a>
                            <a class="nav-link text-center custom-tab nav-pill-tab" href="#"
                                onclick="setActiveModalTab(event, 'modalForm3')">
                                <span class="px-4 py-2 d-inline-block rounded-pill">
                                    Kualifikasi & Kompetensi Akademik Lulusan
                                </span>
                            </a>
                            <a class="nav-link text-center custom-tab nav-pill-tab" href="#"
                                onclick="setActiveModalTab(event, 'modalForm4')">
                                <span class="px-4 py-2 d-inline-block rounded-pill">
                                    Nomor SKPI
                                </span>
                            </a>
                        </nav>

                        <!-- Form Container -->
                        <div id="modalFormContainer">
                            <!-- Tab 1: Identitas Pemegang SKPI -->
                            <form id="modalForm2" method="POST" action="#">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Akreditasi Institusi <span style="font-weight: 200; font-style:italic;">
                                                    (Versi Bahasa Indonesia) </span>*</label>
                                            <select name="akreditasi_institusi" class="form-control">
                                                <option selected="selected">-- Pilih Akreditasi --</option>
                                                <option value="unggul">Unggul</option>
                                                <option value="baik sekali">Baik Sekali</option>
                                                <option value="baik">Baik</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Program Studi <span style="font-weight: 200; font-style:italic;"> (Versi
                                                    Bahasa Indonesia) </span>*</label>
                                            <input type="text" class="form-control" name="program_studi"
                                                placeholder="Masukkan program studi">
                                        </div>
                                        <div class="form-group">
                                            <label>Jenis & Program Pendidikan <span
                                                    style="font-weight: 200; font-style:italic;"> (Versi Bahasa Indonesia)
                                                </span>*</label>
                                            <select name="jenis_pendidikan" class="form-control">
                                                <option selected="selected">-- Pilih Jenis & Program Pendidikan --</option>
                                                <option value="vokasi & d2">Vokasi & Diploma 2</option>
                                                <option value="vokasi & d3">Vokasi & Diploma 3</option>
                                                <option value="vokasi & d4">Vokasi & Diploma 4</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="gelar" class="form-label">Gelar <span
                                                    style="font-weight: 200; font-style:italic;"> (Versi Bahasa Indonesia)
                                                </span>*</label>
                                            <input type="text" name="gelar" class="form-control"
                                                placeholder="Masukkan gelar">
                                        </div>
                                        <div class="form-group">
                                            <label for="kualifikasi_kkni" class="form-label">Jenjang Kualifikasi Sesuai
                                                KKNI <span style="font-weight: 200; font-style:italic;"> (Versi Bahasa
                                                    Indonesia) </span>*</label>
                                            <input type="text" class="form-control" name="kualifikasi_kkni"
                                                placeholder="Masukkan jenjang kualifikasi KKNI">
                                        </div>
                                        <div class="form-group">
                                            <label for="persyaratan_penerimaan" class="form-label">Persyaratan Penerimaan
                                                <span style="font-weight: 200; font-style:italic;"> (Versi Bahasa
                                                    Indonesia) </span>*</label>
                                            <input type="text" class="form-control" name="persyaratan_penerimaan"
                                                placeholder="Masukkan persyaratan penerimaan">
                                        </div>
                                        <div class="form-group">
                                            <label for="bahasa_pengantar" class="form-label">Bahasa Pengantar Kuliah <span
                                                    style="font-weight: 200; font-style:italic;"> (Versi Bahasa Indonesia)
                                                </span>*</label>
                                            <input type="text" class="form-control" name="bahasa_pengantar"
                                                placeholder="Masukkan bahasa pengantar">
                                        </div>
                                        <div class="form-group">
                                            <label for="lama_studi" class="form-label">Lama Studi Reguler <span
                                                    style="font-weight: 200; font-style:italic;"> (Versi Bahasa Indonesia)
                                                </span>*</label>
                                            <input type="text" class="form-control" name="lama_studi"
                                                placeholder="Masukkan lama studi">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Institution's Accreditation <span
                                                    style="font-weight: 200; font-style:italic;"> (English Version)
                                                </span>*</label>
                                            <select name="institution_acc" class="form-control">
                                                <option selected="selected">-- Choose Accreditation --</option>
                                                <option value="superior">Superior</option>
                                                <option value="very good">Very Good</option>
                                                <option value="good">Good</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Study Program <span style="font-weight: 200; font-style:italic;">
                                                    (English Version) </span>*</label>
                                            <input type="text" class="form-control" name="study_program"
                                                placeholder="Enter study program">
                                        </div>
                                        <div class="form-group">
                                            <label>Type & Level of Education <span
                                                    style="font-weight: 200; font-style:italic;"> (English Version)
                                                </span>*</label>
                                            <select name="education_type" class="form-control">
                                                <option selected="selected">-- Choose Level & Type of Education --</option>
                                                <option value="vocation & d2">Vocation & Associate Degree</option>
                                                <option value="vocation & d3">Vocation & Bachelor Degree</option>
                                                <option value="vocation & d4">Vocation & Bachelor Degree</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="degree" class="form-label">Academic Degree <span
                                                    style="font-weight: 200; font-style:italic;"> (English Version)
                                                </span>*</label>
                                            <input type="text" class="form-control" name="degree"
                                                placeholder="Enter academic degree">
                                        </div>
                                        <div class="form-group">
                                            <label for="kkni_level" class="form-label">Level in the Indonesian
                                                Qualification Framework <span style="font-weight: 200; font-style:italic;">
                                                    (English Version) </span>*</label>
                                            <input type="text" class="form-control" name="kkni_level"
                                                placeholder="Enter KKNI level">
                                        </div>
                                        <div class="form-group">
                                            <label for="admission_requirement" class="form-label">Admission Requirements
                                                <span style="font-weight: 200; font-style:italic;"> (English Version)
                                                </span>*</label>
                                            <input type="text" class="form-control" name="admission_requirement"
                                                placeholder="Enter admission requirements">
                                        </div>
                                        <div class="form-group">
                                            <label for="instruction_language" class="form-label">Language of Instruction
                                                <span style="font-weight: 200; font-style:italic;"> (English Version)
                                                </span>*</label>
                                            <input type="text" class="form-control" name="instruction_language"
                                                placeholder="Enter instruction language">
                                        </div>
                                        <div class="form-group">
                                            <label for="length_study" class="form-label">Regular Length of Study <span
                                                    style="font-weight: 200; font-style:italic;"> (English Version)
                                                </span>*</label>
                                            <input type="text" class="form-control" name="length_study"
                                                placeholder="Enter length of study">
                                        </div>
                                    </div>
                                </div>

                                {{-- <div class="d-flex justify-content-end mt-4">
                                    <button type="button" class="btn btn-primary"
                                        onclick="setActiveModalTab(null, 'modalForm2', true)">
                                        Selanjutnya
                                    </button>
                                </div> --}}
                            </form>

                            <!-- Tab 2: Kualifikasi & Kompetensi Akademik Lulusan -->
                            <form id="modalForm3" method="POST" action="#" style="display: none;">
                                @csrf

                                <!-- Sikap -->
                                <div class="row mb-2 mx-2">
                                    <div class="col-6 font-weight-bold">Sikap <span
                                            style="font-weight: 200; font-style:italic;"> (Versi Bahasa Indonesia) </span>*
                                    </div>
                                    <div class="col-6 font-weight-bold">Attitude <span
                                            style="font-weight: 200; font-style:italic;"> (English Version) </span>*</div>
                                </div>
                                <div id="modal-statement-container1">
                                    <div class="row mb-2 mx-2 align-items-center">
                                        <div>
                                            <input type="checkbox" class="form-check-input mt-1">
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <textarea name="sikap[]" rows="2" class="form-control auto-resize" placeholder="Masukkan sikap"></textarea>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <textarea name="attitude[]" rows="2" class="form-control auto-resize" placeholder="Enter attitude"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 mx-3">
                                    <button type="button" class="btn" style="background-color: #9CC0FA;"
                                        onclick="tambahPernyataanModal('modal-statement-container1', 'sikap', 'attitude')">+
                                        Tambah Pernyataan</button>
                                    <button type="button" class="btn btn-danger"
                                        onclick="hapusModal('modal-statement-container1')">Hapus</button>
                                </div>

                                <!-- Penguasaan Pengetahuan -->
                                <div class="row mb-2 mx-2">
                                    <div class="col-6 font-weight-bold">Penguasaan Pengetahuan <span
                                            style="font-weight: 200; font-style:italic;"> (Versi Bahasa Indonesia) </span>*
                                    </div>
                                    <div class="col-6 font-weight-bold">Knowledge <span
                                            style="font-weight: 200; font-style:italic;"> (English Version) </span>*</div>
                                </div>
                                <div id="modal-statement-container2">
                                    <div class="row mb-2 mx-2 align-items-center">
                                        <div>
                                            <input type="checkbox" class="form-check-input mt-1">
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <textarea name="penguasaan_pengetahuan[]" rows="2" class="form-control auto-resize"
                                                placeholder="Masukkan penguasaan pengetahuan"></textarea>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <textarea name="knowledge[]" rows="2" class="form-control auto-resize" placeholder="Enter knowledge"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 mx-3">
                                    <button type="button" class="btn" style="background-color: #9CC0FA;"
                                        onclick="tambahPernyataanModal('modal-statement-container2', 'penguasaan_pengetahuan', 'knowledge')">+
                                        Tambah Pernyataan</button>
                                    <button type="button" class="btn btn-danger"
                                        onclick="hapusModal('modal-statement-container2')">Hapus</button>
                                </div>

                                <!-- Keterampilan Umum -->
                                <div class="row mb-2 mx-2">
                                    <div class="col-6 font-weight-bold">Keterampilan Umum <span
                                            style="font-weight: 200; font-style:italic;"> (Versi Bahasa Indonesia) </span>*
                                    </div>
                                    <div class="col-6 font-weight-bold">General Skills <span
                                            style="font-weight: 200; font-style:italic;"> (English Version) </span>*</div>
                                </div>
                                <div id="modal-statement-container3">
                                    <div class="row mb-2 mx-2 align-items-center">
                                        <div>
                                            <input type="checkbox" class="form-check-input mt-1">
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <textarea name="keterampilan_umum[]" rows="2" class="form-control auto-resize"
                                                placeholder="Masukkan keterampilan umum"></textarea>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <textarea name="general_skills[]" rows="2" class="form-control auto-resize"
                                                placeholder="Enter general skills"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 mx-3">
                                    <button type="button" class="btn" style="background-color: #9CC0FA;"
                                        onclick="tambahPernyataanModal('modal-statement-container3', 'keterampilan_umum', 'general_skills')">+
                                        Tambah Pernyataan</button>
                                    <button type="button" class="btn btn-danger"
                                        onclick="hapusModal('modal-statement-container3')">Hapus</button>
                                </div>

                                <!-- Keterampilan Khusus -->
                                <div class="row mb-2 mx-2">
                                    <div class="col-6 font-weight-bold">Keterampilan Khusus <span
                                            style="font-weight: 200; font-style:italic;"> (Versi Bahasa Indonesia) </span>*
                                    </div>
                                    <div class="col-6 font-weight-bold">Special Skills <span
                                            style="font-weight: 200; font-style:italic;"> (English Version) </span>*</div>
                                </div>
                                <div id="modal-statement-container4">
                                    <div class="row mb-2 mx-2 align-items-center">
                                        <div>
                                            <input type="checkbox" class="form-check-input mt-1">
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <textarea name="keterampilan_khusus[]" rows="2" class="form-control auto-resize"
                                                placeholder="Masukkan keterampilan khusus"></textarea>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <textarea name="special_skills[]" rows="2" class="form-control auto-resize"
                                                placeholder="Enter special skills"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 mx-3">
                                    <button type="button" class="btn" style="background-color: #9CC0FA;"
                                        onclick="tambahPernyataanModal('modal-statement-container4', 'keterampilan_khusus', 'special_skills')">+
                                        Tambah Pernyataan</button>
                                    <button type="button" class="btn btn-danger"
                                        onclick="hapusModal('modal-statement-container4')">Hapus</button>
                                </div>

                                {{-- <div class="d-flex justify-content-between mt-4">
                                    <button type="button" class="btn btn-secondary"
                                        onclick="setActiveModalTab(null, 'modalForm1', true)">
                                        Sebelumnya
                                    </button>
                                    <button type="button" class="btn btn-primary"
                                        onclick="setActiveModalTab(null, 'modalForm3', true)">
                                        Selanjutnya
                                    </button>
                                </div> --}}
                            </form>

                            <!-- Tab 1: Identitas Pemegang SKPI -->
                            <form id="modalForm1" method="POST" action="#">
                                @csrf
                                <div class="d-flex flex-row justify-content-around mb-4">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label class="form-label text-label">Nama Lengkap <span
                                                    class="italic-parentheses">(Versi Bahasa Indonesia)</span> *</label>
                                            <input type="text" name="nama_lengkap" class="form-control input-text">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label text-label">Tempat dan Tanggal Lahir <span
                                                    class="italic-parentheses">(Versi Bahasa Indonesia)</span> *</label>
                                            <input type="text" name="ttl" class="form-control input-text">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label text-label">Nomor Pokok Mahasiswa <span
                                                    class="italic-parentheses">(Versi Bahasa Indonesia)</span> *</label>
                                            <input type="text" name="nim" class="form-control input-text">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label text-label">Tanggal Masuk <span
                                                    class="italic-parentheses">(Versi Bahasa Indonesia)</span> *</label>
                                            <input type="text" name="tanggal_masuk" class="form-control input-text">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label text-label">Tanggal Lulus <span
                                                    class="italic-parentheses">(Versi Bahasa Indonesia)</span> *</label>
                                            <input type="text" name="tanggal_lulus" class="form-control input-text">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label text-label">Nomor Ijazah Nasional <span
                                                    class="italic-parentheses">(Versi Bahasa Indonesia)</span> *</label>
                                            <input type="text" name="no_ijazah" class="form-control input-text">
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label class="form-label text-label">Full Name <span
                                                    class="italic-parentheses">(English Version)</span> *</label>
                                            <input type="text" name="full_name" class="form-control input-text">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label text-label">Date and Place of Birth <span
                                                    class="italic-parentheses">(English Version)</span> *</label>
                                            <input type="text" name="date_place_birth"
                                                class="form-control input-text">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label text-label">Student ID <span
                                                    class="italic-parentheses">(English Version)</span> *</label>
                                            <input type="text" name="student_id" class="form-control input-text">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label text-label">Date of Admission <span
                                                    class="italic-parentheses">(English Version)</span> *</label>
                                            <input type="text" name="admission_date" class="form-control input-text">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label text-label">Date of Completion <span
                                                    class="italic-parentheses">(English Version)</span> *</label>
                                            <input type="text" name="completion_date" class="form-control input-text">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label text-label">Diploma Number <span
                                                    class="italic-parentheses">(English Version)</span> *</label>
                                            <input type="text" name="diploma_number" class="form-control input-text">
                                        </div>
                                    </div>
                                </div>

                                {{-- <div class="d-flex justify-content-end mt-4">
                                    <button type="button" class="btn btn-primary"
                                        onclick="setActiveModalTab(null, 'modalForm2', true)">
                                        Selanjutnya
                                    </button>
                                </div> --}}
                            </form>

                            <!-- Tab 4: Nomor SKPI -->
                            <form id="modalForm4" method="POST" action="#" style="display: none;">
                                @csrf
                                <div class="row mb-2 mx-2">
                                    <div class="col-6 font-weight-bold">Nomor SKPI <span
                                            style="font-weight: 200; font-style:italic;"> (Versi Bahasa Indonesia) </span>*
                                    </div>
                                    <div class="col-6 font-weight-bold">Attitude<span
                                            style="font-weight: 200; font-style:italic;"> (English Version) </span>*</div>
                                </div>
                                <div id="modal-statement-container5">
                                    <div class="row mb-2 mx-2 align-items-center">
                                        <div>
                                            <input type="checkbox" class="form-check-input mt-1">
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <textarea name="nomor_skpi[]" rows="2" class="form-control auto-resize" placeholder="Masukkan nomor SKPI"></textarea>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <textarea name="attitudes[]" rows="2" class="form-control auto-resize" placeholder="Enter attitude"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 mx-3">
                                    <button type="button" class="btn" style="background-color: #9CC0FA;"
                                        onclick="tambahPernyataanModal('modal-statement-container5', 'nomor_skpi', 'skpi_number')">+
                                        Tambah Pernyataan</button>
                                    <button type="button" class="btn btn-danger"
                                        onclick="hapusModal('modal-statement-container5')">Hapus</button>
                                </div>
                                <div class="d-flex justify-content-between mt-4">
                                    {{-- <button type="button" class="btn btn-secondary"
                                        onclick="setActiveModalTab(null, 'modalForm3', true)">
                                        Sebelumnya
                                    </button> --}}
                                    <div></div>
                                    <div class="d-flex justify-content-end">
                                        <button type="button" class="btn btn-secondary me-2 mr-2">
                                            Tutup
                                        </button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


{{-- @extends('baak.masterBaak')

@section('title', 'Dashboard BAAK')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <h4 class="m-0 font-weight-bold text-primary">Dashboard</h4>
  </div>
</div>

<section class="content">
  <div class="container-fluid">

    <!-- Welcome Card -->
    <div class="card mb-4 position-relative" id="welcome-card" style="background: linear-gradient(90deg, #4150B5, #4A67D6); color: white;">
      <div class="card-body">
        <button class="close text-white position-absolute" onclick="document.getElementById('welcome-card').remove()"
                style="top: 10px; right: 15px; background: none; border: none; font-size: 20px;">
          &times;
        </button>
        <h5 class="text-white">Selamat Datang, <strong>Admin BAAK</strong></h5>
        <p class="text-white mb-0">Pantau pengajuan SKPI mahasiswa pada dashboard ini.</p>
      </div>
    </div>

    <!-- Kotak Statistik -->
    <div class="row">
      <div class="col-lg-3 col-6 mb-3">
        <div class="small-box d-flex flex-column align-items-start justify-content-center text-start px-4 py-4"
             style="background-color: #3B82F6; color: white; border-radius: 0.25rem; height: 150px;">
          <i class="fas fa-file-alt fa-2x mt-3"></i>
          <h3 class="mt-2 mb-0">{{ $total_pengajuan }}</h3>
          <p style="font-size: 13px;">Total Pengajuan SKPI</p>
        </div>
      </div>

      <div class="col-lg-3 col-6 mb-3">
        <div class="small-box d-flex flex-column align-items-start justify-content-center text-start px-4 py-4"
             style="background-color: #EAB308; color: white; border-radius: 0.25rem; height: 150px;">
          <i class="fas fa-sync-alt fa-2x mb-2 mt-3"></i>
          <h3 class="mt-2 mb-0">{{ $proses_verifikasi }}</h3>
          <p style="font-size: 13px;">Proses Verifikasi</p>
        </div>
      </div>

      <div class="col-lg-3 col-6 mb-3">
        <div class="small-box d-flex flex-column align-items-start justify-content-center text-start px-4 py-4"
             style="background-color: #059669; color: white; border-radius: 0.25rem; height: 150px;">
          <i class="fas fa-check-circle fa-2x mb-2 mt-3"></i>
          <h3 class="mt-2 mb-0">{{ $telah_diverifikasi }}</h3>
          <p style="font-size: 13px;">Telah Diverifikasi</p>
        </div>
      </div>

      <div class="col-lg-3 col-6 mb-3">
        <div class="small-box d-flex flex-column align-items-start justify-content-center text-start px-4 py-4"
             style="background-color: #BA2532; color: white; border-radius: 0.25rem; height: 150px;">
          <i class="fas fa-exclamation-triangle fa-2x mb-2 mt-3"></i>
          <h3 class="mt-2 mb-0">{{ $pengajuan_direvisi }}</h3>
          <p style="font-size: 13px;">Pengajuan Direvisi</p>
        </div>
      </div>
    </div>

    <!-- Chart SKPI -->
    <div class="row">
      <div class="col-lg-7 connectedSortable">
        <div class="card mb-4">
          <div class="card-header">
            <h3 class="card-title">Statistik Pengajuan SKPI</h3>
          </div>
          <div class="card-body">
            <div id="skpi-chart" style="min-height: 300px;"></div>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js" crossorigin="anonymous"></script>

<script>
   const skpi_chart_options = {
    series: [
        { name: 'Total Pengajuan SKPI', data: {!! json_encode($datasets['total_pengajuan']) !!} },
        { name: 'Proses Verifikasi', data: {!! json_encode($datasets['proses_verifikasi']) !!} },
        { name: 'Telah Diverifikasi', data: {!! json_encode($datasets['telah_diverifikasi']) !!} },
        { name: 'Pengajuan Direvisi', data: {!! json_encode($datasets['pengajuan_direvisi']) !!} },
    ],
    chart: {
        type: 'area',
        height: 230,
        toolbar: { show: false }
    },
    colors: ['#3B82F6', '#EAB308', '#059669', '#BA2532'],
    dataLabels: { enabled: false },
    stroke: { curve: 'smooth' },
    fill: { type: 'gradient', gradient: { opacityFrom: 0.5, opacityTo: 0.1 } },
    xaxis: {
        type: 'datetime',
        categories: {!! json_encode($tanggalLabels) !!}, // Formatnya harus ISO (yyyy-MM-dd)
        labels: {
            format: "MMM 'yy" // untuk tampil Jan '25, Feb '25, dst
        }
    },
    tooltip: {
        x: {
            format: "MMMM yyyy"
        }
    }
};
    const skpi_chart = new ApexCharts(document.querySelector("#skpi-chart"), skpi_chart_options);
    skpi_chart.render();
</script>
@endpush



 --}}
@push('scripts')
    <script>
        function setActiveModalTab(event, formId, skipEvent = false) {
            if (event && !skipEvent) {
                event.preventDefault();
            }

            // Hide semua form
            document.querySelectorAll('#modalFormContainer form').forEach(form => {
                form.style.display = 'none';
            });

            // Remove active class dari semua tabs
            document.querySelectorAll('#modalTabs .nav-link').forEach(tab => {
                tab.classList.remove('active');
                tab.querySelector('span').classList.remove('custom-tab-active');
            });

            // Show form yang dipilih
            document.getElementById(formId).style.display = 'block';

            // Add active class ke tab yang dipilih
            if (event && !skipEvent) {
                event.target.closest('.nav-link').classList.add('active');
                event.target.closest('.nav-link').querySelector('span').classList.add('custom-tab-active');
            } else {
                // Jika dipanggil programmatically, cari tab yang sesuai
                const targetTab = formId === 'modalForm1' ? 0 :
                    formId === 'modalForm2' ? 1 :
                    formId === 'modalForm3' ? 2 : 3;
                const tabs = document.querySelectorAll('#modalTabs .nav-link');
                tabs[targetTab].classList.add('active');
                tabs[targetTab].querySelector('span').classList.add('custom-tab-active');
            }
        }

        // Fungsi untuk tambah pernyataan di modal
        function tambahPernyataanModal(containerId, name1, name2) {
            console.log('Adding statement to:', containerId, name1, name2); // Debug
            const container = document.getElementById(containerId);

            if (!container) {
                console.error('Container not found:', containerId);
                return;
            }

            const newRow = document.createElement('div');
            newRow.className = 'row mb-2 mx-2 align-items-center';

            // Buat placeholder yang lebih readable
            const placeholder1 = name1.replace(/_/g, ' ').replace(/\b\w/g, l => l.toUpperCase());
            const placeholder2 = name2.replace(/_/g, ' ').replace(/\b\w/g, l => l.toUpperCase());

            newRow.innerHTML = `
                <div>
                    <input type="checkbox" class="form-check-input mt-1">
                </div>
                <div class="col-md-6 mb-2">
                    <textarea name="${name1}[]" rows="2" class="form-control auto-resize" placeholder="Masukkan ${placeholder1}"></textarea>
                </div>
                <div class="col-md-6 mb-2">
                    <textarea name="${name2}[]" rows="2" class="form-control auto-resize" placeholder="Enter ${placeholder2}"></textarea>
                </div>
            `;

            container.appendChild(newRow);
            console.log('Statement added successfully'); // Debug
        }

        // Fungsi untuk hapus pernyataan yang dipilih di modal
        function hapusModal(containerId) {
            // const container = document.getElementById(containerId);

            // if (!container) {
            //     console.error('Container not found:', containerId);
            //     return;
            // }

            // const checkboxes = container.querySelectorAll('input[type="checkbox"]:checked');
            // const allRows = container.querySelectorAll('.row.mb-2.mx-2.align-items-center');

            // // Jika tidak ada yang di-checkbox, tampilkan pesan
            // if (checkboxes.length === 0) {
            //     alert('Pilih item yang ingin dihapus dengan mencentang checkbox terlebih dahulu.');
            //     return;
            // }

            // // Jika akan menghapus semua item, pastikan minimal 1 tersisa
            // if (checkboxes.length >= allRows.length) {
            //     alert('Tidak dapat menghapus semua item. Minimal harus ada 1 item yang tersisa.');
            //     return;
            // }

            // // Konfirmasi penghapusan
            // const confirmed = confirm(`Anda yakin ingin menghapus ${checkboxes.length} item yang dipilih?`);

            // if (confirmed) {
            //     checkboxes.forEach(checkbox => {
            //         const row = checkbox.closest('.row.mb-2.mx-2.align-items-center');
            //         if (row) {
            //             row.remove();
            //         }
            //     });

            //     console.log(`${checkboxes.length} items deleted from ${containerId}`);
            // }
            const container = document.getElementById(containerId);

            if (!container) {
                console.error('Container not found:', containerId);
                return;
            }

            const allRows = container.querySelectorAll('.row.mb-2.mx-2.align-items-center');

            if (allRows.length <= 1) {
                alert('Tidak dapat menghapus item. Minimal harus ada 1 item yang tersisa.');
                return;
            }

            // Konfirmasi penghapusan
            const confirmed = confirm('Anda yakin ingin menghapus item terakhir?');

            if (confirmed) {
                const lastRow = allRows[allRows.length - 1];
                lastRow.remove();
                console.log('Last item deleted from', containerId);
            }
        }

        // Fungsi untuk hapus semua item kecuali yang pertama
        function resetContainer(containerId) {
            const container = document.getElementById(containerId);

            if (!container) {
                console.error('Container not found:', containerId);
                return;
            }

            const rows = container.querySelectorAll('.row.mb-2.mx-2.align-items-center');

            // Hapus semua kecuali yang pertama
            for (let i = 1; i < rows.length; i++) {
                rows[i].remove();
            }

            // Reset nilai di row pertama
            const firstRow = container.querySelector('.row.mb-2.mx-2.align-items-center');
            if (firstRow) {
                const textareas = firstRow.querySelectorAll('textarea');
                const checkbox = firstRow.querySelector('input[type="checkbox"]');

                textareas.forEach(textarea => textarea.value = '');
                if (checkbox) checkbox.checked = false;
            }
        }

        // Fungsi untuk select/deselect all checkboxes dalam container
        function toggleAllCheckboxes(containerId) {
            const container = document.getElementById(containerId);

            if (!container) {
                console.error('Container not found:', containerId);
                return;
            }

            const checkboxes = container.querySelectorAll('input[type="checkbox"]');
            const allChecked = Array.from(checkboxes).every(cb => cb.checked);

            // Jika semua sudah dicentang, uncheck semua. Jika tidak, check semua
            checkboxes.forEach(checkbox => {
                checkbox.checked = !allChecked;
            });
        }

        // Reset modal ketika ditutup
        $('#exampleModal').on('hidden.bs.modal', function() {
            // Reset ke tab pertama
            setActiveModalTab(null, 'modalForm1', true);

            // Reset semua form
            document.querySelectorAll('#modalFormContainer form').forEach(form => {
                form.reset();
            });

            // Reset containers ke kondisi awal
            ['modal-statement-container1', 'modal-statement-container2', 'modal-statement-container3',
                'modal-statement-container4', 'modal-statement-container5'
            ].forEach(containerId => {
                resetContainer(containerId);
            });
        });

        // Set tab pertama sebagai active saat modal dibuka
        $('#exampleModal').on('shown.bs.modal', function() {
            setActiveModalTab(null, 'modalForm1', true);
        });

        // Event listener untuk double-click pada container untuk select all
        document.addEventListener('DOMContentLoaded', function() {
            ['modal-statement-container1', 'modal-statement-container2', 'modal-statement-container3',
                'modal-statement-container4', 'modal-statement-container5'
            ].forEach(containerId => {
                const container = document.getElementById(containerId);
                if (container) {
                    // Double click untuk select/deselect all
                    container.addEventListener('dblclick', function(e) {
                        if (e.target.closest('.row')) {
                            toggleAllCheckboxes(containerId);
                        }
                    });
                }
            });
        });
    </script>
@endpush
