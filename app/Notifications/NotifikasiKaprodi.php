<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\User; // Keep this
use App\Models\Mahasiswa; // This might not be needed in the Notification if you only use User models

class NotifikasiKaprodi extends Notification
{
    use Queueable;

    public $komentar;
    public $admin;
    public $mahasiswa; // This will now be a User model
    public $judul;
    public $kodeProdi;

    /**
     * Buat instance baru notifikasi.
     */
    public function __construct($judul, $komentar, User $admin, User $mahasiswa, $kodeProdi) // Correct as is
    {
        $this->judul = $judul;
        $this->komentar = $komentar;
        $this->admin = $admin;
        $this->mahasiswa = $mahasiswa;
        $this->kodeProdi = $kodeProdi;
    }

    /**
     * Tentukan channel notifikasi.
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Data yang disimpan di database.
     */


    public function toDatabase($notifiable)
    {
        return [
            'title'           => $this->judul,
            'message'         => 'Komentar: ' . $this->komentar,
            'admin_name'      => $this->admin->nama ?? $this->admin->username ?? 'Admin Tidak Dikenal',
            'admin_id'        => $this->admin->id ?? null,
            'nim'             => $this->mahasiswa->mahasiswa->nim ?? '-',
            'nama_mahasiswa'  => $this->mahasiswa->nama ?? $this->mahasiswa->name ?? '-',
            'kode_prodi'      => $this->kodeProdi,
        ];
    }

}