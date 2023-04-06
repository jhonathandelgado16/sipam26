<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VacinaAplicada extends Model
{
    use HasFactory;

    protected $fillable = [
        'data_aplicacao',
        'militar_id',
        'vacina_id',
    ];

    public function militar(){
        return $this->belongsTo(Militar::class);
    }

    public function vacina(){
        return $this->belongsTo(Vacina::class);
    }

    public function getDataFormatada(){
        return implode("/",array_reverse(explode("-",$this->data_aplicacao)));
    }
}
