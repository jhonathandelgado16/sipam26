<?php

namespace App\Http\Controllers;

use App\Models\CnhCategoria;
use Illuminate\Http\Request;

class CnhCategoriaController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:admin', ['only' => ['index','store','create', 'update']]);
    }

    public function index()
    {
        $cnh_categorias = CnhCategoria::orderBy('categoria','ASC')->get();
        return view('curso_formacao_condutores.cnh_categoria.index',compact('cnh_categorias'));
    }

    public function create()
    {
        return view('curso_formacao_condutores.cnh_categoria.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'categoria' => 'required|unique:cnh_categorias',
            'pontos' => 'required',
        ]);

        $cnh_categoria = CnhCategoria::create(['categoria' => strtoupper($request->input('categoria')), 'pontos' => $request->input('pontos')]);

        return redirect()->route('cnh_categorias.index')
                        ->with('success','Categoria '. $cnh_categoria->categoria .', cadastrada com sucesso!');
    }

    public function edit($id)
    {
        $cnh_categoria = CnhCategoria::find($id);
        return view('curso_formacao_condutores.cnh_categoria.edit',compact('cnh_categoria'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'categoria' => 'required',
            'pontos' => 'required',
        ]);

        $cnh_categoria = CnhCategoria::find($id);
        $cnh_categoria->categoria = strtoupper($request->input('categoria'));
        $cnh_categoria->pontos = $request->input('pontos');
        $cnh_categoria->save();

        return redirect()->route('cnh_categorias.index')
                        ->with('success','Categoria '. $cnh_categoria->categoria .', atualizada com Sucesso!');
    }
}
