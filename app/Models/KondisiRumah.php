<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class KondisiRumah extends Model
{
    use HasFactory;
    protected $table = 'kondisi_rumahs';
    protected $fillable = ['admin_id' , 'ortu_id' , 'status_rumah' , 'level_bangunan' , 'berkas_surat_pajak' , 'photo'];

}
