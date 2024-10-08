<?php

namespace App\Http\Controllers;

use App\Models\AvaliacaoMilitar;
use App\Models\AvaliacaoMilitarAtributo;
use App\Models\CnhMilitar;
use App\Models\CursoFormacaoMilitar;
use App\Models\Militar;
use App\Models\MilitarCurso;
use App\Models\MilitarDemerito;
use App\Models\MilitarEscolaridade;
use Illuminate\Http\Request;

class FichaSipamController extends Controller
{
    public function index(Request $request, $id)
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

        $militar = Militar::find($id);
        $escolaridade = MilitarEscolaridade::select('escolaridades.nome', 'escolaridades.pontos', 'militar_escolaridades.instituicao_ensino')->where('militar_id', $id)->join('escolaridades', 'escolaridades.id', '=', 'militar_escolaridades.escolaridade_id')->orderBy('escolaridades.pontos', 'desc')->first();
        $cursos = MilitarCurso::select('curso_id', 'data_conclusao', 'pontuando', 'cursos.horas')->where('militar_id', $id)->where('pontuando', 1)->join('cursos', 'cursos.id', '=', 'militar_cursos.curso_id')->orderBy('cursos.horas','DESC')->whereBetween('data_conclusao', [$data_inicio, $data_final])->limit(3)->get();
        $taf_realizados = $militar->getTafRealizados();
        $taf_recente = $taf_realizados->first();
        $taf_realizados->forget(0);
        $curso_formacao = CursoFormacaoMilitar::where('militar_id', $militar->id)->join('curso_formacaos', 'curso_formacaos.id', '=', 'curso_formacao_militars.curso_formacao_id')->orderBy('pontos', 'DESC')->first();
        $cnh_militar = CnhMilitar::where('militar_id', $militar->id)->join('cnh_categorias', 'cnh_categorias.id', '=', 'cnh_militars.cnh_categoria_id')->orderBy('pontos', 'DESC')->first();
        $atributos_basicos = AvaliacaoMilitarAtributo::getAtributosBasicos($militar->id, 2);
        $atributos_funcionais = AvaliacaoMilitarAtributo::getAtributosFuncionais($militar->id, 2);
        $demeritos = MilitarDemerito::where('militar_id', $militar->id)->get();

        $avalicao_militar = AvaliacaoMilitar::where('militar_id', $militar->id)
            ->where('situacao', 2)
            ->whereBetween('avaliacao_militars.created_at', [$data_inicio, $data_final])
            ->first();

            // dd($cursos);
        return view('ficha_sipam.index', compact('demeritos','escolaridade','militar', 'cursos', 'taf_realizados', 'taf_recente', 'curso_formacao', 'cnh_militar', 'atributos_basicos', 'atributos_funcionais', 'avalicao_militar'));       
    }
}

