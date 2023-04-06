<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FatoObservado extends Model
{
    use HasFactory;


    protected $fillable = [
        'fato_observado',
        'data_lancamento',
        'militar_que_observou',
        'descricao',
        'militar_id',
        'user_id',
    ];

    public function militar(){
        return $this->belongsTo(Militar::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getDataFormatada(){
        return implode("/",array_reverse(explode("-",$this->data_lancamento)));
    }
}
