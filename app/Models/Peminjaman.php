<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nim_mahasiswa',
        'nip_staff',
        'nip_staff_in_charge',
        'pjm_purpose',
        'ruangan_id',
        'expected_return_date',
        'real_return_date',
        'pjm_type',
        'pjm_status', //1 : Need Approve, 2: Berhasil, 3: Ditolak, 4: Belum Kembali, 5: Selesai.
        'pjm_notes'  
    ];

    // Join
    public function mahasiswa_peminjam_model(){
        return $this->belongsTo(Mahasiswa::class, 'nim_mahasiswa', 'nim');
    }
    public function staff_peminjam_model(){
        return $this->belongsTo(Staff::class, 'nip_staff', 'nip');
    }
    public function staff_in_charge_model(){
        return $this->belongsTo(Staff::class, 'nip_staff', 'nip');
    }
    public function ruangan_model(){
        return $this->belongsTo(Ruangan::class, 'ruangan_id', 'id');
    }

    public function detail_peminjaman_model(){
        return $this->hasMany(DetailPeminjaman::class,'pjm_id', 'id');
    }
}
