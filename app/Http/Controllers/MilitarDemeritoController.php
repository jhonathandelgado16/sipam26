<?php

namespace App\Http\Controllers;

use App\Models\Demerito;
use App\Models\Militar;
use App\Models\MilitarDemerito;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MilitarDemeritoController extends Controller
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
        $demeritos = MilitarDemerito::where('militar_id', $id)->get();
        return view('ficha_sipam.demeritos.index', compact('demeritos', 'militar'));
    }

    public function create($id)
    {
        $user_auth = Auth::user();
        $militar = Militar::find($id);
        $demeritos = Demerito::where('posto_id', $militar->posto_id)->get();
        return view('ficha_sipam.demeritos.create', compact('demeritos', 'militar'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'militar_id' => 'required',
            'demerito_id' => 'required',
            'documento' => 'required',
            'numero' => 'required',
            'data' => 'required',
        ]);

        $publicacao = $request->input('documento') . ' Nº ' . $request->input('numero') . ' de '. date('d/m/Y', strtotime($request->input('data')));

        $demerito = MilitarDemerito::create(['militar_id' => $request->input('militar_id'), 'demerito_id' => $request->input('demerito_id'), 'publicacao' => $publicacao]);

        return redirect()->route('ficha_sipam.demerito_index', $request->input('militar_id'))
                        ->with('success','Demérito lançado com sucesso!');
    }

    public function edit($id)
    {
        $user_auth = Auth::user();
        $militar_demerito = MilitarDemerito::find($id);
        $militar = Militar::find($militar_demerito->militar_id);
        $demeritos = Demerito::where('posto_id', $militar->posto_id)->get();
        return view('ficha_sipam.demeritos.edit', compact('demeritos', 'militar_demerito', 'militar'));
    }

    public function update(Request $request, string $id)
    {
        $user_auth = Auth::user();
        $this->validate($request, [
            'demerito_id' => 'required',
            'publicacao' => 'required'
        ]);

        $militar_demerito = MilitarDemerito::find($id);
        $militar_demerito->demerito_id = $request->input('demerito_id');
        $militar_demerito->publicacao = $request->input('publicacao');
        $militar_demerito->save();
        
        return redirect()
            ->route('ficha_sipam.demerito_index', $request->input('militar_id'))
            ->with('success', 'Demérito atualizado com Sucesso!');
    }

    public function destroy($id)
    {
        $militar_demerito = MilitarDemerito::find($id);
        $militar_demerito->delete();
        return redirect()->route('ficha_sipam.demerito_index', $militar_demerito->militar_id)
                        ->with('success','Demérito excluido com sucesso!');
    }
}
