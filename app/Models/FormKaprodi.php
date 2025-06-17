<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormKaprodi extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'form_skpi';
    public $timestamps = false;
    protected $fillable = [
        'akreditasi_institusi',
        'kode_prodi',
        'jenis_pendidikan',
        'gelar',
        'kualifikasi_kkni',
        'persyaratan_penerimaan',
        'bahasa_pengantar',
        'lama_studi',
        'sikap',
        'penguasaan_pengetahuan',
        'keterampilan_umum',
        'keterampilan_khusus',
        'institution_acc',
        'study_program',
        'education_type',
        'degree',
        'kkni_level',
        'adminission_requirement',
        'instruction_language',
        'length_study',
        'attitude',
        'knowledge',
        'general_skills',
        'special_skills'
    ];

    protected $casts = [
        'sikap' => 'array',
        'attitude' => 'array',
        'penguasaan_pengetahuan' => 'array',
        'knowledge' => 'array',
        'keterampilan_umum' => 'array',
        'general_skills' => 'array',
        'keterampilan_khusus' => 'array',
        'special_skills' => 'array',
    ];

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'kode_prodi', 'kode prodi');
    }
}
