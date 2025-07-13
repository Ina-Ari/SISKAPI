<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Services\Skpi\SkpiDocumentServiceInterface;
use App\Support\Resolvers\UserRelationResolver;
use Illuminate\Http\Request;
use App\Models\Prodi;
use App\Models\FormKaprodi;
use App\Models\KepalaProdi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Validation\Rules\File;
use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\TemplateProcessor;
use SebastianBergmann\Type\TrueType;

class KaprodiController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil ID kepala prodi dari user yang login
        $user = Auth::user(); 

        $kepalaProdiProfile = $user->kepalaProdi;

        // Hitung jumlah notifikasi belum dibaca
        $jumlahNotif = $kepalaProdiProfile->unreadNotifications->count();

        // $kodeProdi = auth()->user()->kepalaProdi->user_id;
        $kodeProdi = $kepalaProdiProfile->user_id;

        // Jika tidak ada kepala prodi terkait, kembalikan data kosong
        if (!$kodeProdi) {
            return view('kaprodi.dashboardKaprodi', [
                'statusCounts' => [],
                'tanggalLabels' => [],
                'grafikDataset' => [],
                'today' => Carbon::now('Asia/Jakarta')->translatedFormat('F Y'),
                'dayName' => Carbon::now('Asia/Jakarta')->translatedFormat('l'),
                'dayNumber' => Carbon::now('Asia/Jakarta')->translatedFormat('d')
            ]);
        }

        // Status count total untuk kotak status (hanya untuk kepala_prodi_id yang sesuai)
        $statusCounts = DB::table('skpi')
            ->select('status', DB::raw('count(*) as total'))
            ->where('kepala_prodi_id', $kodeProdi)
            ->groupBy('status')
            ->pluck('total', 'status');

        // Ambil data grafik: group by tanggal dan status
        $grafikDataRaw = DB::table('skpi')
            ->select(DB::raw('DATE(updated_at) as tanggal'), 'status', DB::raw('count(*) as jumlah'))
            ->where('kepala_prodi_id', $kodeProdi)
            ->groupBy('tanggal', 'status')
            ->orderBy('tanggal')
            ->get();

        // Format data jadi per tanggal dengan masing-masing status (1-5)
        $dataByTanggal = [];
        foreach ($grafikDataRaw as $row) {
            $dataByTanggal[$row->tanggal][$row->status] = $row->jumlah;
        }

        // Ambil semua tanggal yang unik
        $tanggalLabels = array_keys($dataByTanggal);

        // Siapkan dataset status 1-5, isian default 0
        $datasets = [];
        for ($status = 1; $status <= 5; $status++) {
            $datasets[$status] = [];
            foreach ($tanggalLabels as $tanggal) {
                $datasets[$status][] = $dataByTanggal[$tanggal][$status] ?? 0;
            }
        }

        // Data untuk tampilan tanggal sekarang
        $now = Carbon::now('Asia/Jakarta');
        $today = $now->translatedFormat('F Y');
        $dayName = $now->translatedFormat('l');
        $dayNumber = $now->translatedFormat('d');

        return view('kaprodi.dashboardKaprodi', [
            'statusCounts' => $statusCounts,
            'tanggalLabels' => $tanggalLabels,
            'grafikDataset' => $datasets,
            'today' => $today,
            'dayName' => $dayName,
            'dayNumber' => $dayNumber,
            'jumlahNotif' => $jumlahNotif,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function formKaprodi()
    {
        // $user = auth()->user();
        $user = Auth::user(); 

        $kode_prodi = UserRelationResolver::getRelationData($user)->prodi->kode_prodi;
        $templateFilename = config('skpi.template.prefix') . $kode_prodi . config('skpi.template.preview.extension');
        $templateFullPath = config('skpi.template.preview.path') . $templateFilename;

        $kaprodi = KepalaProdi::where('user_id', $user->id)->firstOrFail();

        $skpi = FormKaprodi::where('kode_prodi', $kaprodi->kode_prodi)->first();
        $sikap = optional($skpi)->sikap ?? [];
        $attitude = optional($skpi)->attitude ?? [];
        $penguasaan_pengetahuan = optional($skpi)->penguasaan_pengetahuan ?? [];
        $knowledge = optional($skpi)->knowledge ?? [];
        $keterampilan_umum = optional($skpi)->keterampilan_umum ?? [];
        $general_skills = optional($skpi)->general_skills ?? [];
        $keterampilan_khusus = optional($skpi)->keterampilan_khusus ?? [];
        $special_skills = optional($skpi)->special_skills ?? [];
        
        // Hitung jumlah notifikasi belum dibaca
        $jumlahNotif = $kaprodi->unreadNotifications->count();

        // $prodiList = Prodi::where('kode_prodi', $kaprodi->kode_prodi)->get();

        $prodi = Prodi::where('kode_jurusan', 40)->get();

        // dd($skpi);
        // dd($Prodi);
        return view('kaprodi.formKaprodi', compact('templateFullPath', 'kaprodi', 'prodi', 'skpi', 'sikap', 'attitude', 'penguasaan_pengetahuan', 'knowledge', 'keterampilan_umum', 'general_skills', 'keterampilan_khusus', 'special_skills', 'jumlahNotif'));
    }

    public function storeSkpi1(Request $request)
    {
        $validated = $request->validate(
            [
                'akreditasi_institusi' => 'required|in:unggul,baik sekali,baik',
                'jenis_pendidikan' => 'required|in:vokasi & d2,vokasi & d3,vokasi & d4',
                'gelar' => 'required',
                'kualifikasi_kkni' => 'required',
                'persyaratan_penerimaan' => 'required',
                'bahasa_pengantar' => 'required',
                'lama_studi' => 'required',
                'institution_acc' => 'required|in:superior,very good,good',
                'education_type' => 'required|in:vocation & d2,vocation & d3,vocation & d4',
                'degree' => 'required',
                'kkni_level' => 'required',
                'adminission_requirement' => 'required',
                'instruction_language' => 'required',
                'length_study' => 'required',
            ],
            [
                'akreditasi_institusi.in' => 'Kolom <b>Akreditasi Institusi</b> tidak boleh kosong!',
                'jenis_pendidikan.in' => 'Kolom <b>Jenis & Program Pendidikan</b> tidak boleh kosong!',
                'gelar.required' => 'Kolom <b>Gelar</b> tidak boleh kosong!',
                'kualifikasi_kkni.required' => 'Kolom <b>Jenjang Kualifikasi Sesuai KKNI</b> tidak boleh kosong!',
                'persyaratan_penerimaan.required' => 'Kolom <b>Persyaratan Penerimaan</b> tidak boleh kosong!',
                'bahasa_pengantar.required' => 'Kolom <b>Bahasa Pengantar Kuliah</b> tidak boleh kosong!',
                'lama_studi.required' => 'Kolom <b>Lama Studi Reguler</b> tidak boleh kosong!',
                'institution_acc.in' => 'Kolom <b>Institution Accrediation</b> tidak boleh kosong!',
                'education_type.in' => 'Kolom <b>Type & Level of Education</b> tidak boleh kosong!',
                'degree.required' => 'Kolom <b>Academyc Degree</b> tidak boleh kosong!',
                'kkni_level.required' => 'Kolom <b>Level in the Indonesian Qualification Framework</b> tidak boleh kosong!',
                'adminission_requirement.required' => 'Kolom <b>Adminission requirements</b> tidak boleh kosong!',
                'instruction_language.required' => 'Kolom <b>Language of Instruction</b> tidak boleh kosong!',
                'length_study.required' => 'Kolom <b>Regular Length of Study</b> tidak boleh kosong!',
            ],
        );

        // Ambil kode_prodi dari user yang login
        $kodeProdi = auth()->user()->kepalaProdi->kode_prodi;

        // Simpan atau update data berdasarkan kode_prodi
        $skpi = FormKaprodi::firstOrNew(['kode_prodi' => $kodeProdi]);

        $skpi->fill($validated); // gunakan fill jika semua key-nya cocok
        $skpi->kode_prodi = $kodeProdi;
        $skpi->study_program = $kodeProdi;

        $skpi->save();

        return redirect()->route('kaprodi.form')->with('success', 'Data Berhasil Disimpan!');
    }

    public function storeSkpi2(Request $request)
    {
        $kodeProdi = auth()->user()->kepalaProdi->kode_prodi;

        $validated = $request->validate(
            [
                'sikap.*' => 'required|string',
                'attitude.*' => 'required|string',
                'penguasaan_pengetahuan.*' => 'required|string',
                'knowledge.*' => 'required|string',
                'keterampilan_umum.*' => 'required|string',
                'general_skills.*' => 'required|string',
                'keterampilan_khusus.*' => 'required|string',
                'special_skills.*' => 'required|string',
            ],
            [
                'sikap.*.required' => 'Setiap kolom <b>Sikap</b> wajib diisi.',
                'penguasaan_pengetahuan.*.required' => 'Setiap kolom <b>Penguasaan Pengetahuan</b> wajib diisi.',
                'keterampilan_umum.*.required' => 'Setiap kolom <b>Keterampilan Umum</b> wajib diisi.',
                'keterampilan_khusus.*.required' => 'Setiap kolom <b>Keterampilan Khusus</b> wajib diisi.',
                'attitude.*.required' => 'Setiap kolom <b>Attitude</b> wajib diisi.',
                'knowledge.*.required' => 'Setiap kolom <b>Knowledge</b> wajib diisi.',
                'general_skills.*.required' => 'Setiap kolom <b>General Skills</b> wajib diisi.',
                'special_skills.*.required' => 'Setiap kolom <b>Special Skills</b> wajib diisi.',
            ],
        );

        $skpi = FormKaprodi::firstOrNew(['kode_prodi' => $kodeProdi]);

        $fields = ['sikap', 'attitude', 'penguasaan_pengetahuan', 'knowledge', 'keterampilan_umum', 'general_skills', 'keterampilan_khusus', 'special_skills'];

        foreach ($fields as $field) {
            $skpi->$field = $request->input($field, null);
        }

        $skpi->kode_prodi = $kodeProdi;
        $skpi->save();

        return redirect()->route('kaprodi.form')->with('success', 'Data Berhasil Disimpan!');
    }

    public function notifKaprodi(Request $request){
        // Ambil user yang sedang login (ini adalah model App\Models\User)
        $user = Auth::user();

        if (!$user || !$user->role || $user->role->nama !== 'Kepala Prodi') {
            abort(403, 'Akses hanya untuk Kepala Prodi');
        }

        $kepalaProdiProfile = $user->kepalaProdi;

        // Hitung jumlah notifikasi belum dibaca
        $jumlahNotif = $kepalaProdiProfile->unreadNotifications->count();

        if (!$kepalaProdiProfile) {
            return redirect()->back()->with('error', 'Profil Kepala Prodi tidak ditemukan untuk pengguna ini.');
        }
        $kepalaProdiProfile->unreadNotifications->markAsRead();
        $notifikasi = $kepalaProdiProfile->notifications()->latest()->get();

        return view('kaprodi.notifikasiKaprodi', compact('notifikasi', 'user', 'jumlahNotif'));
    }

 

}
