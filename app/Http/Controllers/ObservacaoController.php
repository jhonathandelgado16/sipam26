<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\FatoObservado;
use App\Models\Militar;
use App\Models\Observacao;
use App\Models\Pelotao;
use App\Models\Posto;
use App\Models\Subunidade;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Illuminate\Support\Facades\Auth;

class ObservacaoController extends Controller
{
    //
    function __construct()
    {
         $this->middleware('permission:militar-caderneta', ['only' => ['inserirObservacao','salvar']]);
    }

    public function inserirObservacao($id_militar)
    {
        $militar = Militar::find($id_militar);
        return view('caderneta.observacao.create', compact('militar'));
    }

    public function salvar(Request $request)
    {
        $this->validate($request, [
            'id_militar' => 'required',
            'militar_que_observou' => 'required',
            'data' => 'required',
            'observacao' => 'required',
        ]);

        $observacao = Observacao::create(['militar_id' => $request->input('id_militar'), 'militar_que_observou' => $request->input('militar_que_observou'), 'data' => $request->input('data'), 'observacao' => $request->input('observacao')]);

        return redirect()->route('caderneta.ficha', $request->input('id_militar'))
                        ->with('success','Observação lançada com sucesso!');
    }
}
