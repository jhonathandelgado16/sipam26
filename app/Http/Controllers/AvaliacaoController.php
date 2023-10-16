<?php

namespace App\Http\Controllers;

use App\Models\AtributoAvaliacao;
use App\Models\AvaliacaoMilitar;
use App\Models\AvaliacaoMilitarAtributo;
use App\Models\CategoriaAvaliacao;
use App\Models\CategoriaAvaliacaoPosto;
use App\Models\Fracao;
use App\Models\Militar;
use App\Models\MilitaresFracao;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AvaliacaoController extends Controller
{
    //

    public function index()
    {
        $user_auth = Auth::user();
        $user = User::findOrFail($user_auth->id);

        $militares_sem_avaliacao = Militar::Select('militars.id', 'numero', 'nome_de_guerra', 'posto_id', 'antiguidade')
            ->join('postos', 'militars.posto_id', '=', 'postos.id')
            ->orderBy('antiguidade', 'ASC')
            ->orderBy('numero')
            ->whereIn(
                'militars.id',
                MilitaresFracao::select('militar_id')
                    ->whereIn(
                        'fracao_id',
                        Fracao::select('id')
                            ->where('user_id', $user->id)
                            ->get()
                            ->toArray(),
                    )
                    ->get()
                    ->toArray(),
            )
            ->whereNotIn(
                'militars.id',
                AvaliacaoMilitar::select('militar_id')
                    ->get()
                    ->toArray(),
            )
            ->get();

        $militares_com_avaliacao = AvaliacaoMilitar::join('militars', 'avaliacao_militars.militar_id', '=', 'militars.id')
            ->whereIn(
                'militars.id',
                MilitaresFracao::select('militar_id')
                    ->whereIn(
                        'fracao_id',
                        Fracao::select('id')
                            ->where('user_id', $user->id)
                            ->get()
                            ->toArray(),
                    )
                    ->get()
                    ->toArray(),
            )
            ->where('avaliacao_militars.situacao', 1)
            ->get();

        $militares_avaliacao_aprovada = AvaliacaoMilitar::join('militars', 'avaliacao_militars.militar_id', '=', 'militars.id')
            ->whereIn(
                'militars.id',
                MilitaresFracao::select('militar_id')
                    ->whereIn(
                        'fracao_id',
                        Fracao::select('id')
                            ->where('user_id', $user->id)
                            ->get()
                            ->toArray(),
                    )
                    ->get()
                    ->toArray(),
            )
            ->where('avaliacao_militars.situacao', 2)
            ->get();

        return view('avaliacoes.index', compact('militares_sem_avaliacao', 'militares_com_avaliacao', 'militares_avaliacao_aprovada'));
    }

    public function realizar($militar_id)
    {
        $militar = Militar::find($militar_id);
        $categoria_avaliacao = CategoriaAvaliacao::find(CategoriaAvaliacaoPosto::where('posto_id', $militar->posto_id)->first()->categoria_avaliacao_id);
        $atributos_basicos = $categoria_avaliacao->getAtributosBasicos();
        $atributos_funcionais = $categoria_avaliacao->getAtributosFuncionais();

        return view('avaliacoes.realizar', compact('militar', 'atributos_basicos', 'atributos_funcionais'));
    }

    public function edit($militar_id)
    {
        $militar = Militar::find($militar_id);

        $atributos_basicos = AvaliacaoMilitarAtributo::getAtributosBasicos($militar_id, 1);
        $atributos_funcionais = AvaliacaoMilitarAtributo::getAtributosFuncionais($militar_id, 1);

        $avalicao_militar = AvaliacaoMilitar::where('militar_id', $militar_id)
            ->where('situacao', 1)
            ->first();

        return view('avaliacoes.edit', compact('militar', 'atributos_basicos', 'atributos_funcionais', 'avalicao_militar'));
    }

    public function aprovar($militar_id)
    {
        $militar = Militar::find($militar_id);

        $atributos_basicos = AvaliacaoMilitarAtributo::getAtributosBasicos($militar_id, 1);
        $atributos_funcionais = AvaliacaoMilitarAtributo::getAtributosFuncionais($militar_id, 1);

        $avalicao_militar = AvaliacaoMilitar::where('militar_id', $militar_id)
            ->where('situacao', 1)
            ->first();

        return view('avaliacoes.aprovar', compact('militar', 'atributos_basicos', 'atributos_funcionais', 'avalicao_militar'));
    }

    public function store(Request $request)
    {
        $user_auth = Auth::user();
        $militar = Militar::find($request->input('militar_id'));
        $categoria_avaliacao = CategoriaAvaliacao::find(CategoriaAvaliacaoPosto::where('posto_id', $militar->posto_id)->first()->categoria_avaliacao_id);
        $atributos_basicos = $categoria_avaliacao->getAtributosBasicos();
        $atributos_funcionais = $categoria_avaliacao->getAtributosFuncionais();
        $total_basicos = 0;
        $total_funcionais = 0;
        $qtd_basicos = 0;
        $qtd_funcionais = 0;

        $dados = [];

        foreach ($atributos_basicos as $atributo) {
            array_push($dados, [
                'atributo_id' => $atributo->id,
                'militar_id' => $militar->id,
                'nota' => $request->input($atributo->id),
                'user_id' => $user_auth->id,
                'fase' => $request->input('fase'),
                'situacao' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
            $qtd_basicos++;
            $total_basicos += (int) $request->input($atributo->id);
        }

        foreach ($atributos_funcionais as $atributo) {
            array_push($dados, [
                'atributo_id' => $atributo->id,
                'militar_id' => $militar->id,
                'nota' => $request->input($atributo->id),
                'user_id' => $user_auth->id,
                'fase' => $request->input('fase'),
                'situacao' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ]);

            $total_funcionais += (int) $request->input($atributo->id);
            $qtd_funcionais++;
        }

        AvaliacaoMilitarAtributo::insert($dados);

        $media_funcional = number_format($total_funcionais / $qtd_funcionais, 2, '.', '');
        $media_basicos = number_format($total_basicos / $qtd_basicos, 2, '.', '');

        $nota_final = number_format(($media_funcional + $media_basicos) / 2, 2, '.', '');

        $avaliacao_militar = AvaliacaoMilitar::create([
            'categoria_avaliacao_id' => $categoria_avaliacao->id,
            'militar_id' => $militar->id,
            'user_id' => $user_auth->id,
            'nota_final' => $nota_final,
            'situacao' => 1,
        ]);

        return redirect()
            ->route('avaliacao.index')
            ->with('success', 'A avaliação do ' . $militar->getMilitar() . ' foi realizada com sucesso!! O conceito do militar foi ' . $nota_final . ' pontos!');
    }

    public function update(Request $request)
    {
        $militar = Militar::find($request->input('militar_id'));
        $atributos_basicos = AvaliacaoMilitarAtributo::getAtributosBasicos($militar->id, 1);
        $atributos_funcionais = AvaliacaoMilitarAtributo::getAtributosFuncionais($militar->id, 1);
        $total_basicos = 0;
        $total_funcionais = 0;
        $qtd_basicos = 0;
        $qtd_funcionais = 0;

        foreach ($atributos_basicos as $atributo) {
            $atributo->nota = $request->input($atributo->id);
            $atributo->save();
            $qtd_basicos++;
            $total_basicos += (int) $request->input($atributo->id);
        }

        foreach ($atributos_funcionais as $atributo) {
            $atributo->nota = $request->input($atributo->id);
            $atributo->save();
            $total_funcionais += (int) $request->input($atributo->id);
            $qtd_funcionais++;
        }

        $media_funcional = number_format($total_funcionais / $qtd_funcionais, 2, '.', '');
        $media_basicos = number_format($total_basicos / $qtd_basicos, 2, '.', '');

        $nota_final = number_format(($media_funcional + $media_basicos) / 2, 2, '.', '');

        $avalicao_militar = AvaliacaoMilitar::where('militar_id', $militar->id)
            ->where('situacao', 1)
            ->first();
        $avalicao_militar->nota_final = $nota_final;
        $avalicao_militar->save();

        return redirect()
            ->route('avaliacao.index')
            ->with('success', 'A avaliação do ' . $militar->getMilitar() . ' foi atualizada com sucesso!! O conceito do militar foi ' . $nota_final . ' pontos!');
    }

    public function aprovar_update(Request $request)
    {
        $militar = Militar::find($request->input('militar_id'));
        $atributos_basicos = AvaliacaoMilitarAtributo::getAtributosBasicos($militar->id, 1);
        $atributos_funcionais = AvaliacaoMilitarAtributo::getAtributosFuncionais($militar->id, 1);

        foreach ($atributos_basicos as $atributo) {
            $atributo->situacao = 2;
            $atributo->save();
        }

        foreach ($atributos_funcionais as $atributo) {
            $atributo->situacao = 2;
            $atributo->save();
        }

        $avalicao_militar = AvaliacaoMilitar::where('militar_id', $militar->id)
            ->where('situacao', 1)
            ->first();
        $avalicao_militar->situacao = 2;
        $avalicao_militar->save();

        return redirect()
            ->route('avaliacao.index')
            ->with('success', 'A avaliação do ' . $militar->getMilitar() . ' foi atualizada com sucesso!! O conceito do militar foi ' . $avalicao_militar->nota_final . ' pontos!');
    }
}
