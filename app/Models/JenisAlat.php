<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisAlat extends Model
{
    use HasFactory;

    protected $table = 'jenis_alat';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'jenis_name',
        'spec_attributes',
    ];

    
}
