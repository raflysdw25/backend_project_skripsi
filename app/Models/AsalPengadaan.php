<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsalPengadaan extends Model
{
    use HasFactory;

    protected $table = 'asal_pengadaan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'asal_pengadaan_name',
    ];
}
