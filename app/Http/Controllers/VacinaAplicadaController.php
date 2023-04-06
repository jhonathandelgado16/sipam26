<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\VacinaAplicada;
use App\Models\Militar;
use App\Models\Vacina;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Illuminate\Support\Facades\Auth;

class VacinaAplicadaController extends Controller
{
    //
    function __construct()
    {
         $this->middleware('permission:militar-caderneta', ['only' => ['inserirVacinaAplicada','salvar']]);
    }

    public function inserirVacinaAplicada($id_militar)
    {
        $militar = Militar::find($id_militar);
        $vacinas = Vacina::all();
        return view('caderneta.vacina_aplicada.create', compact('militar', 'vacinas'));
    }

    public function salvar(Request $request)
    {
        $this->validate($request, [
            'militar_id' => 'required',
            'vacina_id' => 'required',
            'data_aplicacao' => 'required',
        ]);

        $vacina_aplicada = VacinaAplicada::create(['militar_id' => $request->input('militar_id'), 'vacina_id' => $request->input('vacina_id'), 'data_aplicacao' => $request->input('data_aplicacao')]);

        return redirect()->route('caderneta.ficha', $request->input('militar_id'))
                        ->with('success','Vacina aplicada com sucesso!');
    }
}
