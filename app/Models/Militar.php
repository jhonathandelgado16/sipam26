<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Militar extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'nome_de_guerra',
        'numero',
        'cpf',
        'idt_militar',
        'endereco',
        'contato',
        'responsavel',
        'subunidade_id',
        'posto_id',
        'pelotao_id'
    ];

    public function subunidade(){
        return $this->belongsTo(Subunidade::class);
    }

    public function pelotao(){
        return $this->belongsTo(Pelotao::class);
    }

    public function posto(){
        return $this->belongsTo(Posto::class);
    }

    public function getMilitar(){
        return $this->posto->posto .' '. $this->numero .' '. $this->nome_de_guerra;
    }

    public function getDataFormatada(){
        return implode("/",array_reverse(explode("-",$this->data_nascimento)));
    }
}
