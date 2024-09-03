<?php

namespace App\Http\Controllers;

use App\Models\CursoFormacao;
use App\Models\CursoFormacaoMilitar;
use App\Models\Militar;
use App\Models\Publicacao;
use Illuminate\Http\Request;

class CursoFormacaoMilitarController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:militar-edit', ['only' => ['index', 'store', 'create', 'update']]);
    }

    public function create($militar_id)
    {
        $militar = Militar::find($militar_id);
        $cursos_formacao = CursoFormacao::all();
        $publicacoes = Publicacao::all();
        return view('cursos_de_formacao.create', compact('militar', 'cursos_formacao', 'publicacoes'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'curso_formacao_id' => 'required',
            'militar_id' => 'required',
            'publicacao_id' => 'required',
        ]);

        $curso_inserido = CursoFormacaoMilitar::create([
                'militar_id' => $request->input('militar_id'),
                'curso_formacao_id' => $request->input('curso_formacao_id'),
                'publicacao_id' => $request->input('publicacao_id'),
        ]);

        return redirect()->route('ficha_sipam.index', $request->input('militar_id'))->with('success', $curso_inserido->curso_formacao->nome .' inserido com sucesso, com esse curso o militar recebeu '. $curso_inserido->curso_formacao->pontos .' pontos!');
    }
}
