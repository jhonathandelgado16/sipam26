<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Posto;
use App\Models\Medico;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Illuminate\Support\Facades\Auth;

class MedicoController extends Controller
{
    //
    function __construct()
    {
         $this->middleware('permission:admin', ['only' => ['index','store']]);
         $this->middleware('permission:admin', ['only' => ['create','store']]);
         $this->middleware('permission:admin', ['only' => ['edit','update']]);
         $this->middleware('permission:admin', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $user_auth = Auth::user();
        $medicos = Medico::all();
        return view('medicos.index',compact('medicos','user_auth'));
    }

    public function create()
    {
        $postos = Posto::whereIn('posto', ['Asp', '2º Ten', '1º Ten'])->get();
        return view('medicos.create', compact('postos'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'posto_id' => 'required',
            'nome' => 'required',
        ]);

        $medico = Medico::create(['posto_id' => $request->input('posto_id'), 'nome' => $request->input('nome')]);

        return redirect()->route('medicos.index')
                        ->with('success','Médico cadastrado com sucesso!');
    }

    public function edit($id)
    {
        $medico = Medico::find($id);
        $postos = Posto::whereIn('posto', ['Asp', '2º Ten', '1º Ten'])->get();
        return view('medicos.edit',compact('medico', 'postos'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'posto_id' => 'required',
            'nome' => 'required',
            'situacao' => 'required',
        ]);

        $medico = Medico::find($id);
        $medico->posto_id = $request->input('posto_id');
        $medico->nome = $request->input('nome');
        $medico->situacao = $request->input('situacao');
        $medico->save();

        return redirect()->route('medicos.index')
                        ->with('success','Médico atualizado com Sucesso!');
    }
}
