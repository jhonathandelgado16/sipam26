<?php

namespace App\Http\Controllers;

use App\Models\CursoFormacao;
use Illuminate\Http\Request;

class CursoFormacaoController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:admin', ['only' => ['index','store','create', 'update']]);
    }

    public function index(Request $request)
    {
        $cursos_formacao = CursoFormacao::orderBy('pontos','DESC')->get();
        return view('cursos_de_formacao.curso_formacao.index',compact('cursos_formacao'));
    }

    public function create()
    {
        return view('cursos_de_formacao.curso_formacao.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nome' => 'required|unique:curso_formacaos',
            'pontos' => 'required',
        ]);

        $curso_formacao = CursoFormacao::create(['nome' => strtoupper($request->input('nome')), 'pontos' => $request->input('pontos')]);

        return redirect()->route('cursos_formacao.index')
                        ->with('success','Curso de Formação cadastrado com sucesso!');
    }

    public function edit($id)
    {
        $curso_formacao = CursoFormacao::find($id);
        return view('cursos_de_formacao.curso_formacao.edit',compact('curso_formacao'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nome' => 'required',
            'pontos' => 'required',
        ]);

        $curso_formacao = CursoFormacao::find($id);
        $curso_formacao->nome = $request->input('nome');
        $curso_formacao->pontos = $request->input('pontos');
        $curso_formacao->save();

        return redirect()->route('cursos_formacao.index')
                        ->with('success','Curso de Formação atualizado com Sucesso!');
    }
}
