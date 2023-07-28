<?php

namespace App\Http\Controllers;

use App\Models\CategoriaAtributo;
use Illuminate\Http\Request;

class CategoriaAtributoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct()
    {
        $this->middleware('permission:admin', ['only' => ['index', 'store', 'create']]);
    }

    public function index()
    {
        $categorias_atributos = CategoriaAtributo::all();
        return view('categorias_atributos.index', compact('categorias_atributos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categorias_atributos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'nome' => 'required',
            'peso' => 'required',
        ]);

        CategoriaAtributo::create(['nome' => $request->input('nome'), 'peso' => $request->input('peso')]);

        return redirect()
            ->route('categorias_atributos.index')
            ->with('success', 'Categoria de Atributos cadastrada com sucesso!');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $categoria_atributo = CategoriaAtributo::find($id);

        return view('categorias_atributos.edit', compact('categoria_atributo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $this->validate($request, [
            'nome' => 'required',
            'peso' => 'required',
            'status' => 'required',
        ]);

        $categoria_atributo = CategoriaAtributo::find($id);
        $categoria_atributo->nome = $request->input('nome');
        $categoria_atributo->status = $request->input('status');
        $categoria_atributo->peso = $request->input('peso');
        $categoria_atributo->save();

        return redirect()
            ->route('categorias_atributos.index')
            ->with('success', 'Categoria de Atributos atualizada com Sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
