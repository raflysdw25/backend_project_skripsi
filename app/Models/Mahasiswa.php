<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa';
    public $primaryKey = 'nim';
    public $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nim',
        'mahasiswa_fullname',
        'email',
        'phone_number',
        'register_year',
        'address',  //nullable
        'prodi_id' //nullable
    ];

    // Join
    public function peminjaman_mahasiswa(){
        return $this->hasMany(Peminjaman::class, 'nim_mahasiswa');
    }

    public function mahasiswa_prodi(){
        return $this->belongsTo(Prodi::class, 'prodi_id', 'id');
    }
}
