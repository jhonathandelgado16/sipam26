<?php

namespace App\Http\Controllers;

use App\Models\Publicacao;
use Illuminate\Http\Request;

class PublicacaoController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:admin', ['only' => ['index', 'store', 'create', 'update']]);
    }

    public function index()
    {
        $publicacoes = Publicacao::orderBy('numero')->get();
        return view('publicacoes.index', compact('publicacoes'));
    }

    public function create()
    {
        return view('publicacoes.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'tipo' => 'required',
            'numero' => 'required',
            'data' => 'required',
            'assunto' => 'required',
        ]);

        $publicacao = Publicacao::create([
            'tipo' => $request->input('tipo'), 
            'numero' => $request->input('numero'),
            'data' => $request->input('data'), 
            'assunto' => $request->input('assunto')
        ]);

        return redirect()
            ->route('publicacoes.index')
            ->with('success', $publicacao->getPublicacao(). ' cadastrada com sucesso!');
    }

    public function edit($id)
    {
        $publicacao = Publicacao::find($id);
        return view('publicacoes.edit', compact('publicacao'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'mencao' => 'required',
            'pontos' => 'required',
        ]);

        $mencao = TafMencao::find($id);
        $mencao->mencao = $request->input('mencao');
        $mencao->pontos = $request->input('pontos');
        $mencao->save();

        return redirect()
            ->route('mencoes_taf.index')
            ->with('success', 'Menção de TAF atualizada com Sucesso!');
    }
}
