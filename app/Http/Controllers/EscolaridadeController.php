<?php

namespace App\Http\Controllers;

use App\Models\Escolaridade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EscolaridadeController extends Controller
{
    //
    function __construct()
    {
        $this->middleware('permission:admin', ['only' => ['index', 'store', 'create']]);
    }

    public function index()
    {
        $user_auth = Auth::user();
        $escolaridades = Escolaridade::all();
        return view('escolaridades.index', compact('escolaridades'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user_auth = Auth::user();
        return view('escolaridades.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $user_auth = Auth::user();
        $this->validate($request, [
            'nome' => 'required',
            'pontos' => 'required',
        ]);

        Escolaridade::create(['nome' => $request->input('nome'), 'pontos' => $request->input('pontos')]);

        return redirect()
            ->route('escolaridades.index')
            ->with('success', 'Escolaridade cadastrada com sucesso!');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $user_auth = Auth::user();
        $escolaridade = Escolaridade::find($id);

        return view('escolaridades.edit', compact('escolaridade'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $user_auth = Auth::user();
        $this->validate($request, [
            'nome' => 'required',
            'pontos' => 'required',
        ]);

        $escolaridade = Escolaridade::find($id);
        $escolaridade->nome = $request->input('nome');
        $escolaridade->pontos = $request->input('pontos');
        $escolaridade->save();

        return redirect()
            ->route('escolaridades.index')
            ->with('success', 'Escolaridade atualizada com Sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
