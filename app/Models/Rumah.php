<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rumah extends Model
{
    use HasFactory;
    protected $table = 'rumahs';
    protected $fillable = ['keterangan'];

    
    public function rumahdetail()
    {
        return $this->hasMany( RumahDetail::class );
    }
}
