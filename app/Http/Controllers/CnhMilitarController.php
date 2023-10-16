<?php

namespace App\Http\Controllers;

use App\Models\CnhCategoria;
use App\Models\CnhMilitar;
use App\Models\Militar;
use Illuminate\Http\Request;

class CnhMilitarController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:militar-edit', ['only' => ['index', 'store', 'create', 'update']]);
    }

    public function create($militar_id)
    {
        $militar = Militar::find($militar_id);
        $cnh_categorias = CnhCategoria::all();
        return view('curso_formacao_condutores.create', compact('militar', 'cnh_categorias'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'cnh_categoria_id' => 'required',
            'militar_id' => 'required',
        ]);

        $cnh_inserida = CnhMilitar::create([
                'militar_id' => $request->input('militar_id'),
                'cnh_categoria_id' => $request->input('cnh_categoria_id'),
        ]);

        return redirect()->route('ficha_sipam.index', $request->input('militar_id'))->with('success', 'Categoria '.$cnh_inserida->cnh_categoria->categoria .' inserida com sucesso, com essa categoria o militar recebeu '. $cnh_inserida->cnh_categoria->pontos .' ponto!');
    }
}
