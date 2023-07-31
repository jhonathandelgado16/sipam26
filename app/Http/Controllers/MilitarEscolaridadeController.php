<?php

namespace App\Http\Controllers;

use App\Models\Escolaridade;
use App\Models\Militar;
use App\Models\MilitarEscolaridade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MilitarEscolaridadeController extends Controller
{
    //
    function __construct()
    {
        $this->middleware('permission:militar-edit', ['only' => ['index', 'store', 'create']]);
    }

    public function index($id)
    {
        $user_auth = Auth::user();
        $militar = Militar::find($id);
        $escolaridades = MilitarEscolaridade::where('militar_id', $id)->get();
        return view('ficha_sipam.escolaridades.index', compact('escolaridades', 'militar'));
    }

    public function create($id)
    {
        $user_auth = Auth::user();
        $militar = Militar::find($id);
        $escolaridades = Escolaridade::all();
        return view('ficha_sipam.escolaridades.create', compact('escolaridades', 'militar'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'militar_id' => 'required',
            'escolaridade_id' => 'required',
            'instituicao_ensino' => 'required',
        ]);

        $escolaridade = MilitarEscolaridade::create(['militar_id' => $request->input('militar_id'), 'instituicao_ensino' => $request->input('instituicao_ensino'), 'escolaridade_id' => $request->input('escolaridade_id')]);

        return redirect()->route('ficha_sipam.escolaridade_index', $request->input('militar_id'))
                        ->with('success','Escolaridade lançada com sucesso!');
    }
}
