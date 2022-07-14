<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrangTua extends Model
{
    use HasFactory;
    protected $table = 'orang_tuas';
    protected $fillable = ['user_id' , 'status' , 'nik', 'berkas_surat' , 'pendidikan' , 'pekerjaan' ];
}
