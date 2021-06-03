<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageAlat extends Model
{
    use HasFactory;

     
    protected $table = 'image_alat';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'alat_id',
        'image_data'
    ];

    // Join
    public function alat_image_model(){
        return $this->belongsTo(Alat::class, 'alat_id', 'id');
    }
}
