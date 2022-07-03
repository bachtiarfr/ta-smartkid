<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ternak extends Model
{
    use HasFactory;

    protected $table = 'ternaks';
    protected $fillable = ['nama'];

   
    public function ternakdetail()
    {
        return $this->hasMany( TernakDetail::class );
    }
}
