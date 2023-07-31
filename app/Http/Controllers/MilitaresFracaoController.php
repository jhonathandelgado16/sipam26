<?php

namespace App\Http\Controllers;

use App\Models\Fracao;
use App\Models\Militar;
use App\Models\MilitaresFracao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MilitaresFracaoController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:admin', ['only' => ['relacionar_militar','index']]);
    }

    public function index()
    {
        $fracoes = Fracao::all();
        return view('militares_fracoes.index',compact('fracoes'));
    }

    public function relacionarMilitar($id){
        $fracao = Fracao::find($id);
        $militares_fracao = MilitaresFracao::where('fracao_id', $id)->get();
        $militares = Militar::Select('militars.id', 'numero', 'nome_de_guerra', 'posto_id', 'antiguidade')->join('postos', 'militars.posto_id', '=', 'postos.id')->
        orderBy('antiguidade', 'ASC')->orderBy('numero')->whereNotIn('militars.id', MilitaresFracao::select('militar_id')->where('fracao_id', $id)->get()->toArray())->get();
        return view('militares_fracoes.inserir',compact('militares_fracao', 'militares','fracao'));
    }

    public function salvarRelacaoMilitar(Request $request, $id)
    {
        $fracao = Fracao::find($id);

        for ($i = 0; $i < count($request->militares); $i++) {
            MilitaresFracao::create([
                'fracao_id' => $fracao->id,
                'militar_id' => $request->militares[$i],
            ]);
        }

        return redirect()
            ->route('militares_fracoes.relacionar', $id)
            ->with('success', 'Militares da Fração atualizados com sucesso!');
    }

    public function removerMilitar(Request $request, $id){
        $fracao_id = MilitaresFracao::find($id)->fracao_id;
        MilitaresFracao::find($id)->delete();
        return redirect()->route('militares_fracoes.relacionar', $fracao_id)
        ->with('success', 'Militares da Fração atualizados com sucesso!');
    }

}
