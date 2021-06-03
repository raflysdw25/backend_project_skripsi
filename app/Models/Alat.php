<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alat extends Model
{
    use HasFactory;

    protected $table = 'alat';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'alat_name',
        'jenis_alat_id',
        'alat_specs',
        'asal_pengadaan_id',
        'alat_year',
        'supplier_id',
        'alat_total'     
    ];

    // Join
    public function details(){
        return $this->hasMany(DetailAlat::class,'alat_id');
    }

    public function supplier_model(){
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }

    public function jenis_alat_model(){
        return $this->belongsTo(JenisAlat::class, 'jenis_alat_id' ,'id');
    }

    public function asal_pengadaan_model(){
        return $this->belongsTo(AsalPengadaan::class, 'asal_pengadaan_id', 'id');
    }

    public function images(){
        return $this->hasMany(ImageAlat::class, 'alat_id', 'id');
    }
}
