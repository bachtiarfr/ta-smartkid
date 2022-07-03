<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $table = 'siswas';
    protected $fillable = [ 'user_id' , 'ortu_id' , 'nisn' , 'jk' , 'jurusan' , 'kelas' , 'berkas_prestasi'];
}
