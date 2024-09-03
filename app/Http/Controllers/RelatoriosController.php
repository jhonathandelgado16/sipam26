<?php

namespace App\Http\Controllers;

use App\Models\Militar;
use App\Models\MilitarCurso;
use App\Models\MilitarDemerito;
use App\Models\Ranking;
use App\Models\Relatorios;
use App\Models\Subunidade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use PDF;

class RelatoriosController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:admin', ['only' => ['faltas']]);
    }

    public function index(Request $request)
    {
        switch (date('m')) {
            case date('m') >= 3:
                $data_inicio = date(date('Y') . '-03-01');
                $data_final = date(date('Y') + 1 . '-03-01');
                break;
            case date('m') <= 3:
                $data_inicio = date(date('Y') - 1 . '-03-01');
                $data_final = date(date('Y') . '-03-01');
                break;
        }

        switch ($request->input('filtro')) {
            case 'escolaridade':
                $filtro_selecionado = 'escolaridade';
                $militares_sem = Relatorios::getMilitaresSemEscolaridade();
                $militares_com = Relatorios::getMilitaresComEscolaridade();
                $qtd_militares_sem = Relatorios::getQtdMilitaresSemEscolaridade();
                $qtd_militares_com = Relatorios::getQtdMilitaresComEscolaridade();
                break;
            case 'curso reengajamento':
                $filtro_selecionado = 'curso reengajamento';
                $militares_sem = Relatorios::getMilitaresSemCursoReengajamento($data_inicio, $data_final);
                $militares_com = Relatorios::getMilitaresComCursoReengajamento($data_inicio, $data_final);
                $qtd_militares_sem = Relatorios::getQtdMilitaresSemCursoReengajamento($data_inicio, $data_final);
                $qtd_militares_com = Relatorios::getQtdMilitaresComCursoReengajamento($data_inicio, $data_final);
                break;
            case 'taf':
                $filtro_selecionado = 'taf';
                $militares_sem = Relatorios::getMilitaresSemTaf($data_inicio, $data_final);
                $militares_com = Relatorios::getMilitaresComTaf($data_inicio, $data_final);
                $qtd_militares_sem = Relatorios::getQtdMilitaresSemTaf($data_inicio, $data_final);
                $qtd_militares_com = Relatorios::getQtdMilitaresComTaf($data_inicio, $data_final);
                break;
            case 'avaliacao':
                $filtro_selecionado = 'avaliacao';
                $militares_sem = Relatorios::getMilitaresSemAvaliacao($data_inicio, $data_final);
                $militares_com = Relatorios::getMilitaresComAvaliacao($data_inicio, $data_final);
                $qtd_militares_sem = Relatorios::getQtdMilitaresSemAvaliacao($data_inicio, $data_final);
                $qtd_militares_com = Relatorios::getQtdMilitaresComAvaliacao($data_inicio, $data_final);
                break;

            default:
                $filtro_selecionado = 'curso reengajamento';
                $militares_sem = Relatorios::getMilitaresSemCursoReengajamento($data_inicio, $data_final);
                $militares_com = Relatorios::getMilitaresComCursoReengajamento($data_inicio, $data_final);
                $qtd_militares_sem = Relatorios::getQtdMilitaresSemCursoReengajamento($data_inicio, $data_final);
                $qtd_militares_com = Relatorios::getQtdMilitaresComCursoReengajamento($data_inicio, $data_final);
                break;
        }

        $filtros = [['id' => 'curso reengajamento', 'descricao' => 'Curso para reengajamento'], ['id' => 'escolaridade', 'descricao' => 'Escolaridades'], ['id' => 'taf', 'descricao' => 'Testes de Aptidão Física'], ['id' => 'avaliacao', 'descricao' => 'Avaliação de Conceito']];
        return view('relatorios.faltas', compact('filtros', 'filtro_selecionado', 'militares_sem', 'militares_com', 'qtd_militares_com', 'qtd_militares_sem'));
    }

    public function pdf()
    {
        $militares = Militar::all();

        foreach ($militares as $militar) {
            Ranking::atualizarNotas($militar->id);
        }
        // $pdf = PDF::loadView('relatorios.pdf.curso_engajamento', compact('resultado', 'subunidades'))->setPaper('a4', 'landscape');
        // return $pdf->stream('ficha acompanhamento.pdf');

        return view('relatorios.pdf.curso_engajamento', compact('resultado', 'subunidades'));
    }

    public function indexPunicoes(Request $request)
    {
        $search = '';
        $search_su = '';
        $subunidades = Subunidade::all();
        $user_auth = Auth::user();
        $user = User::findOrFail($user_auth->id);

        $militares = Militar::select('militars.id', 'numero', 'nome_de_guerra', 'posto_id', 'antiguidade')->join('postos', 'militars.posto_id', '=', 'postos.id')->whereIn('militars.id', MilitarDemerito::select('militar_id')
        ->whereRaw('SUBSTRING_INDEX(publicacao, "/", -1) = YEAR(CURDATE())')->groupBy('militar_id')->get()->toArray())->orderBy('antiguidade', 'ASC')->orderBy('numero', 'ASC');

        $militares = $militares->where('situacao', 'ativa')->get();

        return view('relatorios.demeritos.index', compact('user_auth', 'militares', 'subunidades', 'search', 'search_su'));
    }

    public function viewPunicoes($id)
    {
        $user_auth = Auth::user();
        $militar = Militar::find($id);
        $demeritos = MilitarDemerito::where('militar_id', $id)->get();
        return view('relatorios.demeritos.view', compact('demeritos', 'militar'));
    }
}
