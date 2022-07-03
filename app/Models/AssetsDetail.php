<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetsDetail extends Model
{
    use HasFactory;

    protected $table = 'assets_details';
    protected $fillable = ['assets_id' , 'key' , 'value'];


    public function assets()
    {
        return $this->belongsTo( Assets::class, 'assets_id' );
    }
}
