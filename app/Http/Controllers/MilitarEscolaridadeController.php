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
        $escolaridades = MilitarEscolaridade::select('escolaridades.nome', 'escolaridades.pontos', 'militar_escolaridades.instituicao_ensino','militar_escolaridades.id')->where('militar_id', $id)->join('escolaridades', 'escolaridades.id', '=', 'militar_escolaridades.escolaridade_id')->orderBy('escolaridades.pontos', 'desc')->get();
        return view('ficha_sipam.escolaridades.index', compact('escolaridades', 'militar'));
    }

    public function create($id)
    {
        $user_auth = Auth::user();
        $militar = Militar::find($id);
        $escolaridades = Escolaridade::all();
        return view('ficha_sipam.escolaridades.create', compact('escolaridades', 'militar'));
    }

    public function edit($id)
    {
        $user_auth = Auth::user();
        $militar_escolaridade = MilitarEscolaridade::find($id);
        $militar = Militar::find($militar_escolaridade->militar_id);
        $escolaridades = Escolaridade::all();
        return view('ficha_sipam.escolaridades.edit', compact('escolaridades', 'militar_escolaridade', 'militar'));
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

    public function update(Request $request, string $id)
    {
        $user_auth = Auth::user();
        $this->validate($request, [
            'escolaridade_id' => 'required',
            'instituicao_ensino' => 'required'
        ]);

        $militar_escolaridade = MilitarEscolaridade::find($id);
        $militar_escolaridade->escolaridade_id = $request->input('escolaridade_id');
        $militar_escolaridade->instituicao_ensino = $request->input('instituicao_ensino');
        $militar_escolaridade->save();
        
        return redirect()
            ->route('ficha_sipam.escolaridade_index', $request->input('militar_id'))
            ->with('success', 'Escolaridade atualizada com Sucesso!');
    }

    public function destroy($id)
    {
        $militar_escolaridade = MilitarEscolaridade::find($id);
        $militar_escolaridade->delete();
        return redirect()->route('ficha_sipam.escolaridade_index', $militar_escolaridade->militar_id)
                        ->with('success','Escolaridade excluida com sucesso!');
    }
}
