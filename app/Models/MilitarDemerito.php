<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MilitarDemerito extends Model
{
    use HasFactory;

    protected $fillable = [
        'demerito_id',
        'publicacao',
        'militar_id'
    ];

    public function militar(){
        return $this->belongsTo(Militar::class);
    }

    public function demerito(){
        return $this->belongsTo(Demerito::class);
    }  
}
