<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitaMedica extends Model
{
    use HasFactory;

    protected $fillable = [
        'data_visita',
        'descricao',
        'militar_id',
        'medico_id',
    ];

    public function militar(){
        return $this->belongsTo(Militar::class);
    }

    public function medico(){
        return $this->belongsTo(Medico::class);
    }

    public function getDataFormatada(){
        return implode("/",array_reverse(explode("-",$this->data_visita)));
    }
}
