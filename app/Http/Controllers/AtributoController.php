<?php

namespace App\Http\Controllers;

use App\Models\Atributo;
use App\Models\CategoriaAtributo;
use Illuminate\Http\Request;

class AtributoController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:admin', ['only' => ['index', 'store', 'create']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $atributos = Atributo::all();
        return view('atributos.index', compact('atributos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categorias_atributos = CategoriaAtributo::all();
        return view('atributos.create', compact('categorias_atributos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'nome' => 'required',
            'categoria_atributo_id' => 'required',
        ]);

        Atributo::create(['nome' => $request->input('nome'), 'categoria_atributo_id' => $request->input('categoria_atributo_id')]);

        return redirect()
            ->route('atributos.index')
            ->with('success', 'Atributo cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $atributo = Atributo::find($id);
        $categorias_atributos = CategoriaAtributo::all();
        return view('atributos.edit', compact('categorias_atributos', 'atributo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $this->validate($request, [
            'nome' => 'required',
            'categoria_atributo_id' => 'required',
            'status' => 'required',
        ]);

        $atributo = Atributo::find($id);
        $atributo->nome = $request->input('nome');
        $atributo->status = $request->input('status');
        $atributo->categoria_atributo_id = $request->input('categoria_atributo_id');
        $atributo->save();
        
        return redirect()
            ->route('atributos.index')
            ->with('success', 'Atributo atualizado com Sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
