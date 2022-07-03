<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianDetail extends Model
{
    use HasFactory;

    protected $table = 'penilaian_details';
    protected $fillable = ['penilaian_id' , 'rumah_id' , 'value_rumah' , 'assets_id' , 'value_assets' , 'ternak_id' , 'value_ternak'];
}
