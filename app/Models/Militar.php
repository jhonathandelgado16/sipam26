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
        'pelotao_id',
        'tipo_sanguineo',
        'data_nascimento'
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

    public function possuiFiibPreenchida(){
        $resultado = FichaIndividualBasica::where('militar_id', $this->id)->get();
        if($resultado->isNotEmpty()){
            return true;
        }
        return false;
    }

    public function getOperador(){
        return User::where('subunidade_id', $this->subunidade_id)->where('email', 'like', 'operador%')->first();
    }

    public function getInformacoesFaat(){
        return FichaAvaliacaoAtributo::where('militar_id', $this->id)->first();
    }

    public function getInformacoesFiib(){
        return FichaIndividualBasica::select('objetivo_instrucao_id', 'padrao_minimo_atingido', 'militar_id')->join('objetivo_instrucaos', 'objetivo_instrucaos.id', '=', 'ficha_individual_basicas.objetivo_instrucao_id')->where('militar_id', $this->id)->orderByRaw('CONVERT(materia, SIGNED) asc')->orderBy('identificacao','asc')->get();
    }

    public function possuiFaatPreenchida(){
        $resultado = FichaAvaliacaoAtributo::where('militar_id', $this->id)->get();
        if($resultado->isNotEmpty()){
            return true;
        }
        return false;
    }
}
