<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RumahDetail extends Model
{
    use HasFactory;

    protected $table = 'rumah_details';
    protected $fillable = ['rumah_id' , 'key' , 'value'];


    public function rumah()
    {
        return $this->belongsTo( Rumah::class, 'rumah_id' );
    }
}
