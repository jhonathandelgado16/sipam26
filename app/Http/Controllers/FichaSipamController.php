<?php

namespace App\Http\Controllers;

use App\Models\Militar;
use App\Models\MilitarCurso;
use App\Models\MilitarEscolaridade;
use Illuminate\Http\Request;

class FichaSipamController extends Controller
{
    //
    public function index(Request $request, $id)
    {
        $militar = Militar::find($id);
        $escolaridade = MilitarEscolaridade::select('escolaridades.nome', 'escolaridades.pontos', 'militar_escolaridades.instituicao_ensino')->where('militar_id', $id)->join('escolaridades', 'escolaridades.id', '=', 'militar_escolaridades.escolaridade_id')->orderBy('escolaridades.pontos', 'desc')->first();
        $cursos = MilitarCurso::select('curso_id', 'data_conclusao', 'pontuando', 'cursos.horas')->where('militar_id', $id)->where('pontuando', 1)->join('cursos', 'cursos.id', '=', 'militar_cursos.curso_id')->orderBy('cursos.horas','DESC')->whereYear('militar_cursos.data_conclusao', '=', date('Y'))->limit(3)->get();
        return view('ficha_sipam.index', compact('escolaridade','militar', 'cursos'));       
    }
}
