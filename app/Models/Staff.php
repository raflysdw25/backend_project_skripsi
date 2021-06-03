<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $table = 'staff';
    public $primaryKey = 'nip';
    public $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nip', 
        'staff_fullname',      
        'email',
        'phone_number',
        'address',
        'prodi_id',
    ];


    // Join
    public function staff_prodi(){
        return $this->belongsTo(Prodi::class, 'prodi_id', 'id');
    }
}
