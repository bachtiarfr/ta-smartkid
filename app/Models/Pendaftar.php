<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftar extends Model
{
    use HasFactory;
    protected $table = 'pendaftars';
    protected $fillable = ['user_id' , 'siswa_id' , 'ortu_id' , 'periode_id'];
}
