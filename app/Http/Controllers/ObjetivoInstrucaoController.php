<?php

namespace App\Http\Controllers;

use App\Models\ObjetivoInstrucao;
use App\Models\QualificacaoMilitar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ObjetivoInstrucaoController extends Controller
{
    //
    function __construct()
    {
         $this->middleware('permission:admin', ['only' => ['index','store', 'create']]);
    }

    public function index(Request $request)
    {
        $user_auth = Auth::user();
        $qms = QualificacaoMilitar::all();
        $objetivos_instrucoes = ObjetivoInstrucao::all();
        return view('objetivos_instrucoes.index',compact('objetivos_instrucoes', 'qms','user_auth'));
    }

    public function create()
    {
        $user_auth = Auth::user();
        $qms = QualificacaoMilitar::all();
        return view('objetivos_instrucoes.create', compact('qms'));
    }


    public function store(Request $request)
    {
        $user_auth = Auth::user();
        $this->validate($request, [
            'identificacao' => 'required',
            'materia' => 'required',
            'referencia' => 'required',
        ]);

        $objetivo_instrucao = ObjetivoInstrucao::create(['identificacao' => $request->input('identificacao'), 'materia' => $request->input('materia'), 'referencia' => $request->input('referencia'), 'dentro_da_fiib' => $request->input('qm_oii')]);

        return redirect()->route('objetivos_instrucoes.index')
                        ->with('success','Objetivo Individual da Instrução cadastrado com sucesso!');
    }

    public function edit($id)
    {
        $user_auth = Auth::user();
        $objetivo_instrucao = ObjetivoInstrucao::find($id);
        $qms = QualificacaoMilitar::all();

        return view('objetivos_instrucoes.edit',compact('objetivo_instrucao', 'qms'));
    }

    public function update(Request $request, $id)
    {
        $user_auth = Auth::user();
        $this->validate($request, [
            'identificacao' => 'required',
            'materia' => 'required',
            'referencia' => 'required',
        ]);

        $objetivo_instrucao = ObjetivoInstrucao::find($id);
        $objetivo_instrucao->identificacao = $request->input('identificacao');
        $objetivo_instrucao->materia = $request->input('materia');
        $objetivo_instrucao->referencia = $request->input('referencia');
        $objetivo_instrucao->dentro_da_fiib = $request->input('dentro_da_fiib');
        $objetivo_instrucao->save();

        return redirect()->route('objetivos_instrucoes.index')
                        ->with('success','Objetivo Individual da Instrução atualizado com Sucesso!');
    }
}

