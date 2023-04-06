<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\FatoObservado;
use App\Models\Militar;
use App\Models\Pelotao;
use App\Models\Posto;
use App\Models\Subunidade;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Illuminate\Support\Facades\Auth;

class FatoObservadoController extends Controller
{
    //
    function __construct()
    {
         $this->middleware('permission:militar-caderneta', ['only' => ['inserirFato','salvar']]);
    }

    public function inserirFato($id_militar)
    {
        $militar = Militar::find($id_militar);
        return view('caderneta.fo.create', compact('militar'));
    }

    public function salvar(Request $request)
    {
        $this->validate($request, [
            'id_militar' => 'required',
            'fato_observado' => 'required',
            'militar_que_observou' => 'required',
            'data_lancamento' => 'required',
            'descricao' => 'required',
        ]);

        $fato_observado = FatoObservado::create(['militar_id' => $request->input('id_militar'), 'fato_observado' => $request->input('fato_observado'), 'militar_que_observou' => $request->input('militar_que_observou'), 'data_lancamento' => $request->input('data_lancamento'), 'descricao' => $request->input('descricao'), 'user_id' => Auth::user()->id]);

        return redirect()->route('caderneta.ficha', $request->input('id_militar'))
                        ->with('success','FO cadastrado com sucesso!');
    }

}
