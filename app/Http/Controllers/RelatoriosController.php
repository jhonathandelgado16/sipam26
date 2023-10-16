<?php

namespace App\Http\Controllers;

use App\Models\Militar;
use App\Models\MilitarCurso;
use App\Models\Relatorios;
use App\Models\Subunidade;
use Illuminate\Http\Request;
use PDF;

class RelatoriosController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:admin', ['only' => ['faltas']]);
    }

    public function index(Request $request)
    {
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
                $militares_sem = Relatorios::getMilitaresSemCursoReengajamento();
                $militares_com = Relatorios::getMilitaresComCursoReengajamento();
                $qtd_militares_sem = Relatorios::getQtdMilitaresSemCursoReengajamento();
                $qtd_militares_com = Relatorios::getQtdMilitaresComCursoReengajamento();
                break;
            case 'taf':
                $filtro_selecionado = 'taf';
                $militares_sem = Relatorios::getMilitaresSemTaf();
                $militares_com = Relatorios::getMilitaresComTaf();
                $qtd_militares_sem = Relatorios::getQtdMilitaresSemTaf();
                $qtd_militares_com = Relatorios::getQtdMilitaresComTaf();
                break;

            default:
                $filtro_selecionado = 'curso reengajamento';
                $militares_sem = Relatorios::getMilitaresSemCursoReengajamento();
                $militares_com = Relatorios::getMilitaresComCursoReengajamento();
                $qtd_militares_sem = Relatorios::getQtdMilitaresSemCursoReengajamento();
                $qtd_militares_com = Relatorios::getQtdMilitaresComCursoReengajamento();
                break;
        }

        $filtros = [['id' => 'curso reengajamento', 'descricao' => 'Curso para reengajamento'], ['id' => 'escolaridade', 'descricao' => 'Escolaridades'], ['id' => 'taf', 'descricao' => 'Testes de Aptidão Física']];
        return view('relatorios.faltas', compact('filtros', 'filtro_selecionado', 'militares_sem', 'militares_com', 'qtd_militares_com', 'qtd_militares_sem'));
    }

    public function pdf()
    {
        $resultado = Relatorios::getMilitaresSemCursoReengajamentoPdf();
        $subunidades = Subunidade::all();

        // $pdf = PDF::loadView('relatorios.pdf.curso_engajamento', compact('resultado', 'subunidades'))->setPaper('a4', 'landscape');
        // return $pdf->stream('ficha acompanhamento.pdf');

        return view('relatorios.pdf.curso_engajamento', compact('resultado', 'subunidades'));
    }
}
