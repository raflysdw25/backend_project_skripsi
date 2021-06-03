<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailAlat extends Model
{
    use HasFactory;

    protected $table = 'detail_alat';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'alat_id',
        'barcode_alat',
        'condition_status', // 1: Pending, 2: Baik, 3: Rusak, 4: Habis, 5: Diperbaiki, 6: Apkir.
        'available_status',// 1: Pending, 2: Tersedia, 3: Tidak Tersedia
        'lokasi_id'    
    ];


    // Join
    public function alat_model(){
        return $this->belongsTo(Alat::class, 'alat_id', 'id');
    }
    public function lokasi_model(){
        return $this->belongsTo(LokasiPenyimpanan::class, 'lokasi_id', 'id');
    }
}
