<?php

namespace App\Http\Controllers;

use App\Models\TafNumero;
use Illuminate\Http\Request;

class TafNumeroController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:admin', ['only' => ['index','store','create', 'update']]);
    }

    public function index(Request $request)
    {
        $numeros = TafNumero::all();
        return view('taf.numeros.index',compact('numeros'));
    }

    public function create()
    {
        return view('taf.numeros.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'numero' => 'required',
        ]);

        $numero = TafNumero::create(['numero' => $request->input('numero')]);

        return redirect()->route('taf_numeros.index')
                        ->with('success','Número de TAF cadastrada com sucesso!');
    }

    public function edit($id)
    {
        $numero = TafNumero::find($id);
        return view('taf.numeros.edit',compact('numero'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'numero' => 'required',
        ]);

        $numero = TafNumero::find($id);
        $numero->numero = $request->input('numero');
        $numero->save();

        return redirect()->route('taf_numeros.index')
                        ->with('success','Número de TAF atualizado com Sucesso!');
    }
}
