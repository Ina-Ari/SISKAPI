<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage; 
use Illuminate\Notifications\Notification;
use App\Models\AuthAdmin;
use App\Models\User;

class NotifikasiMhs extends Notification
{
    use Queueable;

    public $komentar;
    public $admin;
    public $namaKegiatan;
    public $tanggalKegiatan; // <-- TAMBAH PROPERTI BARU

    /**
     * Create a new notification instance.
     *
     * @param string $komentar
     * @param User $admin
     * @param string $namaKegiatan
     * @param string $tanggalKegiatan // <-- PARAMETER BARU
     * @return void
     */
    public function __construct($komentar, User $admin, $namaKegiatan, $tanggalKegiatan)
    {
        $this->komentar = $komentar;
        $this->admin = $admin;
        $this->namaKegiatan = $namaKegiatan;
        $this->tanggalKegiatan = $tanggalKegiatan; // <-- SIMPAN NILAI
    }

    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    public function toDatabase($notifiable)
    {
        $adminName = $this->admin->nama ?? $this->admin->username ?? 'Admin Tidak Dikenal';
        $adminId = $this->admin->id_admin ?? $this->admin->id ?? null;

        return [
            'admin_name'        => $adminName,
            'admin_id'          => $adminId,
            'komentar'          => $this->komentar,
            'nama_kegiatan'     => $this->namaKegiatan,
            'tanggal_kegiatan'  => $this->tanggalKegiatan,
            'nim'               => $notifiable->mahasiswa->nim ?? '-', 
            'nama_mahasiswa'    => $notifiable->nama ?? '-',    
        ];
    }

    public function toMail($notifiable)
    {
        $mahasiswaName = $notifiable->nama ?? 'Mahasiswa';
        $adminSignature = $this->admin->nama ?? $this->admin->username ?? 'Admin';

        return (new MailMessage)
            ->subject('Komentar Baru untuk Kegiatan Anda')
            ->greeting('Halo ' . $mahasiswaName . ',')
            ->line('Anda menerima komentar baru dari admin untuk kegiatan:')
            ->line('**Kegiatan: ' . $this->namaKegiatan . '**')
            ->line('Tanggal Pengajuan: ' . $this->tanggalKegiatan) // <-- TAMBAH KE EMAIL
            ->line('Komentar: "' . $this->komentar . '"')
            ->line('— ' . $adminSignature)
            ->action('Lihat Notifikasi', url('/mahasiswa/notifikasi'))
            ->line('Terima kasih telah menggunakan layanan kami.');
    }
}
