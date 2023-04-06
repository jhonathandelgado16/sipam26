<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Observacao extends Model
{
    use HasFactory;

    protected $fillable = [
        'data',
        'militar_que_observou',
        'observacao',
        'militar_id',
    ];

    public function militar(){
        return $this->belongsTo(Militar::class);
    }

    public function getDataFormatada(){
        return implode("/",array_reverse(explode("-",$this->data)));
    }
}
