<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Militar extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'nome_de_guerra', 'numero', 'cpf', 'idt_militar', 'endereco', 'contato', 'responsavel', 'subunidade_id', 'posto_id', 'pelotao_id', 'tipo_sanguineo', 'data_nascimento', 'turma'];

    public function subunidade()
    {
        return $this->belongsTo(Subunidade::class);
    }

    public function pelotao()
    {
        return $this->belongsTo(Pelotao::class);
    }

    public function posto()
    {
        return $this->belongsTo(Posto::class);
    }

    public function qualificacao_militar()
    {
        return $this->belongsTo(QualificacaoMilitar::class);
    }

    public function getMilitar()
    {
        return $this->posto->posto . ' ' . $this->numero . ' ' . $this->nome_de_guerra;
    }

    public function getDataFormatada()
    {
        return implode('/', array_reverse(explode('-', $this->data_nascimento)));
    }

    public function possuiFiibPreenchida()
    {
        $resultado = FichaIndividualBasica::join('objetivo_instrucaos', 'objetivo_instrucaos.id', '=', 'ficha_individual_basicas.objetivo_instrucao_id')->where('militar_id', $this->id)->where('objetivo_instrucaos.dentro_da_fiib', '50')->get();
        if ($resultado->isNotEmpty()) {
            return true;
        }
        return false;
    }

    public function possuiFiiqPreenchida()
    {
        $resultado = FichaIndividualBasica::join('objetivo_instrucaos', 'objetivo_instrucaos.id', '=', 'ficha_individual_basicas.objetivo_instrucao_id')->where('militar_id', $this->id)->where('objetivo_instrucaos.dentro_da_fiib', '!=', '50')->get();
        if ($resultado->isNotEmpty()) {
            return true;
        }
        return false;
    }

    public function getOperador()
    {
        return User::where('subunidade_id', $this->subunidade_id)
            ->where('email', 'like', 'operador%')
            ->first();
    }

    public function getInformacoesFaat()
    {
        return FichaAvaliacaoAtributo::where('militar_id', $this->id)->first();
    }

    public function getInformacoesFiib()
    {
        return FichaIndividualBasica::select('objetivo_instrucao_id', 'padrao_minimo_atingido', 'militar_id')
            ->join('objetivo_instrucaos', 'objetivo_instrucaos.id', '=', 'ficha_individual_basicas.objetivo_instrucao_id')
            ->where('militar_id', $this->id)
            ->where('dentro_da_fiib', 50)
            ->orderByRaw('CONVERT(materia, SIGNED) asc')
            ->orderBy('identificacao', 'asc')
            ->get();
    }

    public function getInformacoesFiiq()
    {
        return FichaIndividualBasica::select('objetivo_instrucao_id', 'padrao_minimo_atingido', 'militar_id')
            ->join('objetivo_instrucaos', 'objetivo_instrucaos.id', '=', 'ficha_individual_basicas.objetivo_instrucao_id')
            ->where('militar_id', $this->id)
            ->where('dentro_da_fiib', $this->qualificacao_militar_id)
            ->orderByRaw('CONVERT(materia, SIGNED) asc')
            ->orderBy('identificacao', 'asc')
            ->get();
    }

    public function possuiFaatPreenchida()
    {
        $resultado = FichaAvaliacaoAtributo::where('militar_id', $this->id)->get();
        if ($resultado->isNotEmpty()) {
            return true;
        }
        return false;
    }

    public function getTafRealizados()
    {
        switch (date('m')) {
            case date('m') >= 3:
                $data_inicio = date((date('Y')).'-03-01');
                $data_final = date((date('Y')+1).'-03-01');
                break;  
            case date('m') <= 3:
                $data_inicio = date((date('Y')-1).'-03-01');
                $data_final = date((date('Y')).'-03-01');
                break;      
        }

        return Taf::where('militar_id', $this->id)
            ->whereBetween('created_at', [$data_inicio, $data_final])
            ->groupBy('taf_numero_id')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getPontosCursos()
    {
        switch (date('m')) {
            case date('m') >= 3:
                $data_inicio = date((date('Y')).'-03-01');
                $data_final = date((date('Y')+1).'-03-01');
                break;  
            case date('m') <= 3:
                $data_inicio = date((date('Y')-1).'-03-01');
                $data_final = date((date('Y')).'-03-01');
                break;      
        }
        $cursos = MilitarCurso::where('militar_id', $this->id)
            ->where('pontuando', 1)
            ->join('cursos', 'cursos.id', '=', 'militar_cursos.curso_id')
            ->orderBy('cursos.horas', 'DESC')
            ->whereBetween('data_conclusao', [$data_inicio, $data_final])
            ->limit(3)
            ->get();

        $pontos = 0;

        foreach ($cursos as $curso) {
            $pontos += $curso->getPontuacaoCurso();
        }

        return $pontos;
    }

    public function getPontosEscolaridade()
    {
        if (
            MilitarEscolaridade::select('escolaridades.pontos')
                ->where('militar_id', $this->id)
                ->join('escolaridades', 'escolaridades.id', '=', 'militar_escolaridades.escolaridade_id')
                ->orderBy('escolaridades.pontos', 'desc')
                ->first() == null
        ) {
            return 0;
        }
        return MilitarEscolaridade::select('escolaridades.pontos')
            ->where('militar_id', $this->id)
            ->join('escolaridades', 'escolaridades.id', '=', 'militar_escolaridades.escolaridade_id')
            ->orderBy('escolaridades.pontos', 'desc')
            ->first()->pontos;
    }

    public function getPontosConhecimento()
    {
        return $this->getPontosCursos() + $this->getPontosEscolaridade();
    }

    public function getPontosTaf()
    {
        switch (date('m')) {
            case date('m') >= 3:
                $data_inicio = date((date('Y')).'-03-01');
                $data_final = date((date('Y')+1).'-03-01');
                break;  
            case date('m') <= 3:
                $data_inicio = date((date('Y')-1).'-03-01');
                $data_final = date((date('Y')).'-03-01');
                break;      
        }

        return Taf::select('taf_mencaos.pontos, taf_numero_id')
            ->where('militar_id', $this->id)
            ->whereBetween('tafs.created_at', [$data_inicio, $data_final])
            ->join('taf_mencaos', 'tafs.taf_mencao_id', 'taf_mencaos.id')
            ->groupBy('taf_numero_id')
            ->orderBy('tafs.created_at', 'desc')
            ->sum('pontos');
    }

    public function getPontosCursoFormacao()
    {
        if (
            CursoFormacaoMilitar::where('militar_id', $this->id)
                ->join('curso_formacaos', 'curso_formacaos.id', '=', 'curso_formacao_militars.curso_formacao_id')
                ->orderBy('pontos', 'DESC')
                ->first() == null
        ) {
            return 0;
        }
        return CursoFormacaoMilitar::where('militar_id', $this->id)
            ->join('curso_formacaos', 'curso_formacaos.id', '=', 'curso_formacao_militars.curso_formacao_id')
            ->orderBy('pontos', 'DESC')
            ->first()->pontos;
    }

    public function getPontosCnh()
    {
        if (
            CnhMilitar::where('militar_id', $this->id)
                ->join('cnh_categorias', 'cnh_categorias.id', '=', 'cnh_militars.cnh_categoria_id')
                ->orderBy('pontos', 'DESC')
                ->first() == null
        ) {
            return 0;
        }
        return CnhMilitar::where('militar_id', $this->id)
            ->join('cnh_categorias', 'cnh_categorias.id', '=', 'cnh_militars.cnh_categoria_id')
            ->orderBy('pontos', 'DESC')
            ->first()->pontos;
    }

    public function getPontosHabilidade()
    {
        if ($this->posto->posto == '3º Sgt') {
            return $this->getPontosTaf() + $this->getPontosCnh();
        }

        return $this->getPontosTaf() + $this->getPontosCursoFormacao() + $this->getPontosCnh();
    }

    public function getPontosAtitude()
    {
        switch (date('m')) {
            case date('m') >= 3:
                $data_inicio = date((date('Y')).'-03-01');
                $data_final = date((date('Y')+1).'-03-01');
                break;  
            case date('m') <= 3:
                $data_inicio = date((date('Y')-1).'-03-01');
                $data_final = date((date('Y')).'-03-01');
                break;      
        }
        
        if (
            AvaliacaoMilitar::where('militar_id', $this->id)
                ->where('situacao', 2)
                ->whereBetween('created_at', [$data_inicio, $data_final])
                ->first() == null
        ) {
            return 0;
        }
        return AvaliacaoMilitar::where('militar_id', $this->id)
            ->where('situacao', 2)
            ->whereBetween('created_at', [$data_inicio, $data_final])
            ->first()->nota_final;
    }

    public function getPontosMilitar()
    {
        return $this->getPontosHabilidade() + $this->getPontosAtitude() + $this->getPontosConhecimento() - $this->getPontosDemerito();
    }

    public function possuiCursoReengajamento()
    {
        switch (date('m')) {
            case date('m') >= 3:
                $data_inicio = date((date('Y')).'-03-01');
                $data_final = date((date('Y')+1).'-03-01');
                break;  
            case date('m') <= 3:
                $data_inicio = date((date('Y')-1).'-03-01');
                $data_final = date((date('Y')).'-03-01');
                break;      
        }
        if (
            MilitarCurso::select('curso_id', 'data_conclusao', 'pontuando', 'cursos.horas')
                ->where('militar_id', $this->id)
                ->where('pontuando', 1)
                ->join('cursos', 'cursos.id', '=', 'militar_cursos.curso_id')
                ->orderBy('cursos.horas', 'DESC')
                ->whereBetween('data_conclusao', [$data_inicio, $data_final])
                ->first() == null
        ) {
            return false;
        }
        return true;
    }

    public function getMencaoUltimoTaf()
    {
        if ($this->getTafRealizados()->first() == null) {
            return 'Não possui';
        }
        return $this->getTafRealizados()->first()->taf_mencao->mencao;
    }

    public function getMaiorMencaoTaf()
    {
        switch (date('m')) {
            case date('m') >= 3:
                $data_inicio = date((date('Y')).'-03-01');
                $data_final = date((date('Y')+1).'-03-01');
                break;  
            case date('m') <= 3:
                $data_inicio = date((date('Y')-1).'-03-01');
                $data_final = date((date('Y')).'-03-01');
                break;      
        }
        $tafs = Taf::where('militar_id', $this->id)
            ->whereBetween('tafs.created_at', [$data_inicio, $data_final])
            ->join('taf_mencaos', 'tafs.taf_mencao_id', 'taf_mencaos.id')
            ->orderBy('taf_mencaos.pontos', 'desc')
            ->get();

        if ($tafs->first() == null) {
            return 'Não possui';
        }
        return $tafs->first()->taf_mencao->mencao;
    }

    public function possuiDemerito()
    {
        if (
            MilitarDemerito::where('militar_id', $this->id)
                ->whereRaw('SUBSTRING_INDEX(publicacao, "/", -1) = YEAR(CURDATE())')
                ->first() == null
        ) {
            return false;
        }
        return true;
    }

    public function getPontosDemerito()
    {
        return MilitarDemerito::select('pontos_demerito')
            ->where('militar_id', $this->id)
            ->join('demeritos', 'militar_demeritos.demerito_id', 'demeritos.id')
            ->whereRaw('SUBSTRING_INDEX(publicacao, "/", -1) = YEAR(CURDATE())')
            ->sum('pontos_demerito');
    }

    public function getQuantidadeAdv(){
        return MilitarDemerito::select('militar_id')->join('demeritos', 'demeritos.id', '=', 'militar_demeritos.demerito_id')->where('militar_id', $this->id)->
        where('descricao', 'Advertência')->whereRaw('SUBSTRING_INDEX(publicacao, "/", -1) = YEAR(CURDATE())')->count();
    }

    public function getQuantidadeImp(){
        return MilitarDemerito::select('militar_id')->join('demeritos', 'demeritos.id', '=', 'militar_demeritos.demerito_id')->where('militar_id', $this->id)->
        where('descricao', 'Impedimento Disciplinar')->whereRaw('SUBSTRING_INDEX(publicacao, "/", -1) = YEAR(CURDATE())')->count();
    }

    public function getQuantidadeRep(){
        return MilitarDemerito::select('militar_id')->join('demeritos', 'demeritos.id', '=', 'militar_demeritos.demerito_id')->where('militar_id', $this->id)->
        where('descricao', 'Repreensão')->whereRaw('SUBSTRING_INDEX(publicacao, "/", -1) = YEAR(CURDATE())')->count();
    }

    public function getQuantidadeDet(){
        return MilitarDemerito::select('militar_id')->join('demeritos', 'demeritos.id', '=', 'militar_demeritos.demerito_id')->where('militar_id', $this->id)->
        where('descricao', 'Detenção Disciplinar')->whereRaw('SUBSTRING_INDEX(publicacao, "/", -1) = YEAR(CURDATE())')->count();
    }

    public function getQuantidadePrisao(){
        return MilitarDemerito::select('militar_id')->join('demeritos', 'demeritos.id', '=', 'militar_demeritos.demerito_id')->where('militar_id', $this->id)->
        where('descricao', 'Prisão Disciplinar')->whereRaw('SUBSTRING_INDEX(publicacao, "/", -1) = YEAR(CURDATE())')->count();
    }
}
