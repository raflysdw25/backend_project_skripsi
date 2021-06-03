<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanKerusakan extends Model
{
    use HasFactory;
    protected $table = 'laporan_kerusakan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nim_mahasiswa',
        'nip_staff',
        'barcode_alat',
        'chronology',
        'report_date',
        'report_status', //1: Menunggu Tindakan, 2: Diperbaiki, 3: Tidak Diperbaiki
        'report_action',
        'report_notes'   
    ];

    // Join
    public function mahasiswa_lapor_model(){
        return $this->belongsTo(Mahasiswa::class, 'nim_mahasiswa', 'nim');
    }
    public function staff_lapor_model(){
        return $this->belongsTo(Staff::class, 'nip_staff', 'nip');
    }

    public function barcode_alat_rusak(){
        return $this->belongsTo(DetailAlat::class, 'barcode_alat', 'barcode_alat');
    }
}
