<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\VisitaMedica;
use App\Models\Militar;
use App\Models\Medico;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Illuminate\Support\Facades\Auth;

class VIsitaMedicaController extends Controller
{
    //
    function __construct()
    {
         $this->middleware('permission:militar-caderneta', ['only' => ['inserirVisitaMedica','salvar']]);
    }

    public function inserirVisitaMedica($id_militar)
    {
        $militar = Militar::find($id_militar);
        $medicos = Medico::where('situacao', 'ATIVA')->get();
        return view('caderneta.visita_medica.create', compact('militar', 'medicos'));
    }

    public function salvar(Request $request)
    {
        $this->validate($request, [
            'militar_id' => 'required',
            'medico_id' => 'required',
            'data_visita' => 'required',
            'descricao' => 'required',
        ]);

        $visita_medica = VisitaMedica::create(['militar_id' => $request->input('militar_id'), 'medico_id' => $request->input('medico_id'), 'data_visita' => $request->input('data_visita'), 'descricao' => $request->input('descricao')]);

        return redirect()->route('caderneta.ficha', $request->input('militar_id'))
                        ->with('success','Visita Médica lançada com sucesso!');
    }
}
