<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa_Prestasi extends Model
{
    use HasFactory;
    protected $table = 'siswa__prestasis';
    protected $fillable = [ 'siswa_id' , 'prestasi' ];
}
