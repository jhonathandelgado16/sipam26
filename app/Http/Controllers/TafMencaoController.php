<?php

namespace App\Http\Controllers;

use App\Models\TafMencao;
use Illuminate\Http\Request;

class TafMencaoController extends Controller
{
    //
    function __construct()
    {
         $this->middleware('permission:admin', ['only' => ['index','store','create', 'update']]);
    }

    public function index(Request $request)
    {
        $mencoes = TafMencao::orderBy('pontos','DESC')->get();
        return view('taf.mencoes.index',compact('mencoes'));
    }

    public function create()
    {
        return view('taf.mencoes.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'mencao' => 'required|unique:taf_mencaos',
            'pontos' => 'required',
        ]);

        $mencao = TafMencao::create(['mencao' => strtoupper($request->input('mencao')), 'pontos' => $request->input('pontos')]);

        return redirect()->route('mencoes_taf.index')
                        ->with('success','Menção de TAF cadastrada com sucesso!');
    }

    public function edit($id)
    {
        $mencao = TafMencao::find($id);
        return view('taf.mencoes.edit',compact('mencao'));
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

        return redirect()->route('mencoes_taf.index')
                        ->with('success','Menção de TAF atualizada com Sucesso!');
    }
}
