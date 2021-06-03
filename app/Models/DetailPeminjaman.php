<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPeminjaman extends Model
{
    use HasFactory;

    protected $table = 'detail_peminjaman';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'barcode_alat',
         'pjm_id',
         'alat_id' 
    ];

    // Join
    public function alat_pinjam(){
        return $this->belongsTo(Alat::class, 'alat_id', 'id');
    }

    public function barcode_alat_pinjam(){
        return $this->belongsTo(DetailAlat::class, 'barcode_alat', 'barcode_alat');
    }

    public function peminjaman(){
        return $this->belongsTo(Peminjaman::class, 'pjm_id', 'id');
    }
}
