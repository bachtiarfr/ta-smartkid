<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory;

    protected $table = 'penilaians';
    protected $fillable = ['siswa_id' , 'penghasilan_id' , 'tanggungan_id' , 'asuransi_id' , 'c1' , 'c2' , 'c3' , 'c4' , 'c5' , 'c6'];
}
