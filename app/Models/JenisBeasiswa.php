<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisBeasiswa extends Model
{
    use HasFactory;
    protected $table = 'jenis_beasiswas';
    protected $fillable = ['nama_beasiswa' , 'user_id'];
}
