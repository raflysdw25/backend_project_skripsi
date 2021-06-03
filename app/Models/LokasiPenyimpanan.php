<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LokasiPenyimpanan extends Model
{
    use HasFactory;

    protected $table = 'lokasi_penyimpanan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'lokasi_name',
        'total_capacity',
        'available_capacity',
        'stored_capacity',     
        'path_qrcode',           
    ];

    // Join
    public function lokasi_detail_alat(){
        return $this->hasMany(DetailAlat::class, 'lokasi_id');
    }
}
