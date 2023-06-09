<?php

namespace App\Http\Controllers;

use App\Models\ObjetivoInstrucao;
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
        $objetivos_instrucoes = ObjetivoInstrucao::all();
        return view('objetivos_instrucoes.index',compact('objetivos_instrucoes','user_auth'));
    }

    public function create()
    {
        return view('objetivos_instrucoes.create');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'identificacao' => 'required',
            'materia' => 'required',
            'referencia' => 'required',
        ]);

        $objetivo_intrucao = ObjetivoInstrucao::create(['identificacao' => $request->input('identificacao'), 'materia' => $request->input('materia'), 'referencia' => $request->input('referencia')]);

        return redirect()->route('objetivos_instrucoes.index')
                        ->with('success','Objetivo Individual da Instrução cadastrado com sucesso!');
    }
}

