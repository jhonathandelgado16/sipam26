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
        'data_nascimento',
        'turma'
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

    public function getTafRealizados(){
        return Taf::where('militar_id', $this->id)->whereYear('created_at', date('Y'))->orderBy('created_at', 'desc')->get();
    }

    public function getPontosCursos(){
        $horas = MilitarCurso::select('cursos.horas')->where('militar_id', $this->id)->where('pontuando', 1)->join('cursos', 'cursos.id', '=', 'militar_cursos.curso_id')->orderBy('cursos.horas','DESC')->whereYear('militar_cursos.data_conclusao', '=', date('Y'))->limit(3)->sum('cursos.horas');
        
        if($horas == 0){
            return 0;
        }

        return round($horas / 100, 2);
    }

    public function getPontosEscolaridade(){

        if(MilitarEscolaridade::select('escolaridades.pontos')->where('militar_id', $this->id)->join('escolaridades', 'escolaridades.id', '=', 'militar_escolaridades.escolaridade_id')->orderBy('escolaridades.pontos', 'desc')->first() == null)
            return 0;
        return MilitarEscolaridade::select('escolaridades.pontos')->where('militar_id', $this->id)->join('escolaridades', 'escolaridades.id', '=', 'militar_escolaridades.escolaridade_id')->orderBy('escolaridades.pontos', 'desc')->first()->pontos;
    }

    public function getPontosConhecimento(){
        return ($this->getPontosCursos() + $this->getPontosEscolaridade());
    }

    public function getPontosTaf(){
        return Taf::select('taf_mencaos.pontos')->where('militar_id', $this->id)->whereYear('tafs.created_at', date('Y'))->join('taf_mencaos', 'tafs.taf_mencao_id', 'taf_mencaos.id')->orderBy('tafs.created_at', 'desc')->sum('pontos');
    }

    public function getPontosCursoFormacao(){
        if(CursoFormacaoMilitar::where('militar_id', $this->id)->join('curso_formacaos', 'curso_formacaos.id', '=', 'curso_formacao_militars.curso_formacao_id')->orderBy('pontos', 'DESC')->first() == null)
            return 0;
        return CursoFormacaoMilitar::where('militar_id', $this->id)->join('curso_formacaos', 'curso_formacaos.id', '=', 'curso_formacao_militars.curso_formacao_id')->orderBy('pontos', 'DESC')->first()->pontos;
    }

    public function getPontosCnh(){
        if(CnhMilitar::where('militar_id', $this->id)->join('cnh_categorias', 'cnh_categorias.id', '=', 'cnh_militars.cnh_categoria_id')->orderBy('pontos', 'DESC')->first() == null)
            return 0;
        return CnhMilitar::where('militar_id', $this->id)->join('cnh_categorias', 'cnh_categorias.id', '=', 'cnh_militars.cnh_categoria_id')->orderBy('pontos', 'DESC')->first()->pontos;
    }

    public function getPontosHabilidade(){
        return ($this->getPontosTaf() + $this->getPontosCursoFormacao() + $this->getPontosCnh());
    }

    public function getPontosAtitude(){
        if(AvaliacaoMilitar::where('militar_id', $this->id)->where('situacao', 2)->first() == null)
            return 0;
        return AvaliacaoMilitar::where('militar_id', $this->id)->where('situacao', 2)->first()->nota_final;
    }

    public function getPontosMilitar(){
        return ($this->getPontosHabilidade() + $this->getPontosAtitude() + $this->getPontosConhecimento());
    }


}
