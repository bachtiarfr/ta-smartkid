<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TernakDetail extends Model
{
    use HasFactory;

    protected $table = 'ternak_details';
    protected $fillable = ['ternak_id' , 'key' , 'value'];

    
    public function ternak()
    {
        return $this->belongsTo( Ternak::class, 'ternak_id' );
    }
}
