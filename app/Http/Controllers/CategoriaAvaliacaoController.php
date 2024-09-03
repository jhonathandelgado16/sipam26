<?php

namespace App\Http\Controllers;

use App\Models\CategoriaAvaliacao;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Atributo;
use App\Models\AtributoAvaliacao;
use App\Models\CategoriaAvaliacaoPosto;
use App\Models\Posto;
use App\Models\Medico;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Illuminate\Support\Facades\Auth;

class CategoriaAvaliacaoController extends Controller
{
    //
    function __construct()
    {
        $this->middleware('permission:admin', ['only' => ['index', 'store', 'create', 'definir']]);
    }

    public function index()
    {
        $user_auth = Auth::user();
        $categorias_avaliacoes = CategoriaAvaliacao::all();
        return view('categorias_avaliacoes.index', compact('categorias_avaliacoes'));
    }

    public function create()
    {
        $user_auth = Auth::user();
        $postos = Posto::orderBy('antiguidade', 'asc')->get();
        return view('categorias_avaliacoes.create', compact('postos'));
    }

    public function store(Request $request)
    {
        $user_auth = Auth::user();
        $this->validate($request, [
            'nome' => 'required',
        ]);

        $categoria_avaliacao = CategoriaAvaliacao::create(['nome' => $request->input('nome')]);

        for ($i = 0; $i < count($request->postos); $i++) {
            CategoriaAvaliacaoPosto::create([
                'categoria_avaliacao_id' => $categoria_avaliacao->id,
                'posto_id' => $request->postos[$i],
            ]);
        }

        return redirect()
            ->route('categorias_avaliacoes.index')
            ->with('success', 'Categoria de Avaliação cadastrada com sucesso!');
    }

    public function edit($id)
    {
        $user_auth = Auth::user();
        $categoria_avaliacao = CategoriaAvaliacao::find($id);
        $postos = Posto::orderBy('antiguidade', 'asc')->get();

        return view('categorias_avaliacoes.edit', compact('categoria_avaliacao', 'postos'));
    }

    public function update(Request $request, $id)
    {
        $user_auth = Auth::user();
        $this->validate($request, [
            'nome' => 'required',
        ]);

        $categoria_avaliacao = CategoriaAvaliacao::find($id);
        $categoria_avaliacao->nome = $request->input('nome');
        $categoria_avaliacao->status = $request->input('status');
        $categoria_avaliacao->save();

        for ($i = 0; $i < count($request->postos); $i++) {
            if (
                !CategoriaAvaliacaoPosto::where('posto_id', $request->postos[$i])
                    ->where('categoria_avaliacao_id', $categoria_avaliacao->id)
                    ->first()
            ) {
                CategoriaAvaliacaoPosto::create([
                    'categoria_avaliacao_id' => $categoria_avaliacao->id,
                    'posto_id' => $request->postos[$i],
                ]);
            }
        }

        $postos_atuais = CategoriaAvaliacaoPosto::where('categoria_avaliacao_id', $categoria_avaliacao->id)->get();

        foreach ($postos_atuais as $posto_atual) {
            if (!in_array($posto_atual->posto_id, $request->postos)) {
                CategoriaAvaliacaoPosto::find($posto_atual->id)->delete();
            }
        }

        return redirect()
            ->route('categorias_avaliacoes.index')
            ->with('success', 'Categoria de Avaliação atualizada com Sucesso!');
    }

    public function definir($categoria_avaliacao_id)
    {
        $user_auth = Auth::user();
        $categoria_avaliacao = CategoriaAvaliacao::find($categoria_avaliacao_id);
        $atributos = Atributo::where('status', 1)
            ->orderBy('categoria_atributo_id', 'asc')
            ->orderBy('nome', 'asc')
            ->get();
        return view('categorias_avaliacoes.definir', compact('atributos', 'categoria_avaliacao'));
    }

    public function definir_store(Request $request)
    {
        $user_auth = Auth::user();
        $this->validate($request, [
            'categoria_avaliacao_id' => 'required',
        ]);

        $categoria_avaliacao = CategoriaAvaliacao::find($request->input('categoria_avaliacao_id'));

        if ($request->atributos != null) {
            for ($i = 0; $i < count($request->atributos); $i++) {
                if (
                    !AtributoAvaliacao::where('atributo_id', $request->atributos[$i])
                        ->where('categoria_avaliacao_id', $categoria_avaliacao->id)
                        ->first()
                ) {
                    AtributoAvaliacao::create([
                        'categoria_avaliacao_id' => $request->input('categoria_avaliacao_id'),
                        'atributo_id' => $request->atributos[$i],
                    ]);
                }
            }
        }

        $atributos_atuais = AtributoAvaliacao::where('categoria_avaliacao_id', $categoria_avaliacao->id)->get();

        if ($request->atributos != null) {
            foreach ($atributos_atuais as $atributo_atual) {
                if (!in_array($atributo_atual->atributo_id, $request->atributos)) {
                    AtributoAvaliacao::find($atributo_atual->id)->delete();
                }
            }
        } else {
            foreach ($atributos_atuais as $atributo_atual) {
                AtributoAvaliacao::find($atributo_atual->id)->delete();
            }
        }

        // for ($i = 0; $i < count($request->atributos); $i++) {
        //     AtributoAvaliacao::create([
        //         'categoria_avaliacao_id' => $request->input('categoria_avaliacao_id'),
        //         'atributo_id' => $request->atributos[$i],
        //     ]);
        // }

        return redirect()
            ->route('categorias_avaliacoes.index')
            ->with('success', 'Atributos inseridos a ' . $categoria_avaliacao->nome . ' com sucesso!');
    }
}
