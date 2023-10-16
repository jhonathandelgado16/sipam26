<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class CategoriaAvaliacao extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'status',
    ];

    public function possuiPosto($posto_id){
        if(CategoriaAvaliacaoPosto::where('posto_id', $posto_id)->where('categoria_avaliacao_id', $this->id)->first())
            return true;
        return false;
    }

    public function possuiAtributo($atributo_id){
        if(AtributoAvaliacao::where('atributo_id', $atributo_id)->where('categoria_avaliacao_id', $this->id)->first())
            return true;
        return false;
    }

    public function getAtributosBasicos(){
        return Atributo::whereIn('id', AtributoAvaliacao::select('atributo_id')->where('categoria_avaliacao_id', $this->id)->get()->toArray())->where('categoria_atributo_id', 2)->get();
    }

    public function getAtributosFuncionais(){
        return Atributo::whereIn('id', AtributoAvaliacao::select('atributo_id')->where('categoria_avaliacao_id', $this->id)->get()->toArray())->where('categoria_atributo_id', 1)->get();
    }
}
