<?php

namespace App\Http\Controllers;

use App\Models\Militar;
use App\Models\QualificacaoMilitar;
use App\Models\Ranking;
use Illuminate\Http\Request;

class RankingController extends Controller
{
    //
    function __construct()
    {
        $this->middleware('permission:admin', ['only' => ['index']]);
    }

    public function index(Request $request)
    {
        switch ($request->input('posto')) {
            case 'todos':             
                    $militares = Ranking::orderBy('nota_final', 'DESC')->join('militars', 'rankings.militar_id', 'militars.id');
                break;
            case 'oficiais':
                $militares = Ranking::select('militar_id', 'rankings.id', 'nota_conhecimento', 'nota_habilidade', 'nota_atitude', 'posto_id', 'nota_final')
                    ->join('militars', 'rankings.militar_id', 'militars.id')
                    ->whereIn('posto_id', [7, 8, 9])
                    ->orderBy('nota_final', 'DESC');
                break;
            case 'sargentos':
                $militares = Ranking::select('militar_id', 'rankings.id', 'nota_conhecimento', 'nota_habilidade', 'nota_atitude', 'posto_id', 'nota_final')
                    ->join('militars', 'rankings.militar_id', 'militars.id')
                    ->whereIn('posto_id', [13])
                    ->orderBy('nota_final', 'DESC');
                break;
            case 'cabos':
                $militares = Ranking::select('militar_id', 'rankings.id', 'nota_conhecimento', 'nota_habilidade', 'nota_atitude', 'posto_id', 'nota_final')
                    ->join('militars', 'rankings.militar_id', 'militars.id')
                    ->whereIn('posto_id', [14])
                    ->orderBy('nota_final', 'DESC');
                break;
            case 'soldados-ep':
                $militares = Ranking::select('militar_id', 'rankings.id', 'nota_conhecimento', 'nota_habilidade', 'nota_atitude', 'posto_id', 'nota_final')
                    ->join('militars', 'rankings.militar_id', 'militars.id')
                    ->whereIn('posto_id', [5])
                    ->orderBy('nota_final', 'DESC');
                break;
            case 'soldados-ev':
                $militares = Ranking::select('militar_id', 'rankings.id', 'nota_conhecimento', 'nota_habilidade', 'nota_atitude', 'posto_id', 'nota_final')
                    ->join('militars', 'rankings.militar_id', 'militars.id')
                    ->whereIn('posto_id', [4])
                    ->orderBy('nota_final', 'DESC');
                break;
            default:
                $militares = Ranking::orderBy('nota_final', 'DESC')->join('militars', 'rankings.militar_id', 'militars.id');
                break;
        }

        $option = $request->input('posto');
        $option_qm = $request->input('qualificacao_militar_id');

        if ($option_qm == 'todos' OR $option_qm == null) {
            $militares = $militares;
        } else {
            $militares = $militares->where('qualificacao_militar_id', $request->input('qualificacao_militar_id'));
        }     
        
        $militares = $militares->where('situacao', 'ativa')->get();

        $qms = QualificacaoMilitar::all();

        return view('ranking.index', compact('militares', 'option', 'qms', 'option_qm'));
    }

    public function atualizar()
    {
        $militares = Militar::all();

        foreach ($militares as $militar) {
            Ranking::atualizarNotas($militar->id);
        }

        return redirect('ranking');
    }
}
