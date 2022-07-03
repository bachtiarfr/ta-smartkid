<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TanggunganAnak extends Model
{
    use HasFactory;

    protected $table = 'tanggungan_anaks';
    protected $fillable = ['jumlah' , 'nilai'];
}
