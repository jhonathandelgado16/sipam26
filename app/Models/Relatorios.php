<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relatorios extends Model
{
    use HasFactory;

    public static function getMilitaresSemCursoReengajamento($data_inicio, $data_final)
    {
        return Militar::select('nome_de_guerra', 'numero', 'posto_id')
            ->whereNotIn(
                'militars.id',
                MilitarCurso::select('militar_id')
                    ->where('pontuando', 1)
                    ->whereBetween('data_conclusao', [$data_inicio, $data_final])
                    // ->whereYear('data_conclusao', '=', date('Y'))
                    ->get()
                    ->toArray(),
            )->whereIn('subunidade_id', [1,2,3,4,5])
            ->where('situacao', 'ativa')
            ->join('postos', 'militars.posto_id', '=', 'postos.id')
            ->orderBy('antiguidade', 'ASC')
            ->orderBy('numero')
            ->get();
    }

    public static function getQtdMilitaresSemCursoReengajamento($data_inicio, $data_final)
    {
        return Militar::select('nome_de_guerra', 'numero', 'posto_id')
            ->whereNotIn(
                'militars.id',
                MilitarCurso::select('militar_id')
                    ->where('pontuando', 1)
                    ->whereBetween('data_conclusao', [$data_inicio, $data_final])
                    ->get()
                    ->toArray(),
            )
            ->where('situacao', 'ativa')
            ->join('postos', 'militars.posto_id', '=', 'postos.id')
            ->orderBy('antiguidade', 'ASC')
            ->orderBy('numero')
            ->count();
    }

    public static function getMilitaresComCursoReengajamento($data_inicio, $data_final)
    {
        return Militar::select('nome_de_guerra', 'numero', 'posto_id')
            ->whereIn(
                'militars.id',
                MilitarCurso::select('militar_id')
                    ->where('pontuando', 1)
                    ->whereBetween('data_conclusao', [$data_inicio, $data_final])
                    ->get()
                    ->toArray(),
            )
            ->where('situacao', 'ativa')
            ->join('postos', 'militars.posto_id', '=', 'postos.id')
            ->orderBy('antiguidade', 'ASC')
            ->orderBy('numero')
            ->get();
    }

    public static function getQtdMilitaresComCursoReengajamento($data_inicio, $data_final)
    {
        return Militar::select('nome_de_guerra', 'numero', 'posto_id')
            ->whereIn(
                'militars.id',
                MilitarCurso::select('militar_id')
                    ->where('pontuando', 1)
                    ->whereBetween('data_conclusao', [$data_inicio, $data_final])
                    ->get()
                    ->toArray(),
            )
            ->where('situacao', 'ativa')
            ->join('postos', 'militars.posto_id', '=', 'postos.id')
            ->orderBy('antiguidade', 'ASC')
            ->orderBy('numero')
            ->count();
    }

    public static function getPorcentagemMilitaresComCursoReengajamento($data_inicio, $data_final)
    {
        $militares_com_curso = Militar::select('nome_de_guerra', 'numero', 'posto_id')
            ->whereIn(
                'militars.id',
                MilitarCurso::select('militar_id')
                    ->where('pontuando', 1)
                    ->whereBetween('data_conclusao', [$data_inicio, $data_final])
                    ->get()
                    ->toArray(),
            )
            ->where('situacao', 'ativa')
            ->join('postos', 'militars.posto_id', '=', 'postos.id')
            ->orderBy('antiguidade', 'ASC')
            ->orderBy('numero')
            ->count();

        $militares = Militar::where('situacao', 'ativa')->count();

        return round((100 * $militares_com_curso) / $militares, 2);
    }

    public static function getPorcentagemMilitaresSemCursoReengajamento($data_inicio, $data_final)
    {
        $militares_sem_curso = Militar::select('nome_de_guerra', 'numero', 'posto_id')
            ->whereNotIn(
                'militars.id',
                MilitarCurso::select('militar_id')
                    ->where('pontuando', 1)
                    ->whereBetween('data_conclusao', [$data_inicio, $data_final])
                    ->get()
                    ->toArray(),
            )
            ->where('situacao', 'ativa')
            ->join('postos', 'militars.posto_id', '=', 'postos.id')
            ->orderBy('antiguidade', 'ASC')
            ->orderBy('numero')
            ->count();

        $militares = Militar::where('situacao', 'ativa')->count();

        return round((100 * $militares_sem_curso) / $militares, 2);
    }

    public static function getMilitaresSemCursoReengajamentoPdf($data_inicio, $data_final){
        $subunidades = Subunidade::all();

        $militares_por_subunidade = [];

        foreach ($subunidades as $subunidade) {
            $militares_por_subunidade[$subunidade->nome] =  Militar::select('nome_de_guerra', 'numero', 'posto_id')
            ->whereNotIn(
                'militars.id',
                MilitarCurso::select('militar_id')
                    ->where('pontuando', 1)
                    ->whereBetween('data_conclusao', [$data_inicio, $data_final])
                    ->get()
                    ->toArray(),
            )
            ->where('situacao', 'ativa')
            ->join('postos', 'militars.posto_id', '=', 'postos.id')
            ->where('subunidade_id', $subunidade->id)
            ->orderBy('antiguidade', 'ASC')
            ->orderBy('numero')
            ->get();
        }

        return $militares_por_subunidade;
    }

    #escolaridade

    public static function getMilitaresSemEscolaridade()
    {
        return Militar::select('nome_de_guerra', 'numero', 'posto_id')
            ->whereNotIn(
                'militars.id',
                MilitarEscolaridade::select('militar_id')
                    ->get()
                    ->toArray(),
            )
            ->where('situacao', 'ativa')
            ->join('postos', 'militars.posto_id', '=', 'postos.id')
            ->orderBy('antiguidade', 'ASC')
            ->orderBy('numero')
            ->get();
    }

    public static function getMilitaresComEscolaridade()
    {
        return Militar::select('nome_de_guerra', 'numero', 'posto_id')
            ->whereIn(
                'militars.id',
                MilitarEscolaridade::select('militar_id')
                    ->get()
                    ->toArray(),
            )
            ->where('situacao', 'ativa')
            ->join('postos', 'militars.posto_id', '=', 'postos.id')
            ->orderBy('antiguidade', 'ASC')
            ->orderBy('numero')
            ->get();
    }

    public static function getQtdMilitaresSemEscolaridade()
    {
        return Militar::select('nome_de_guerra', 'numero', 'posto_id')
            ->whereNotIn(
                'militars.id',
                MilitarEscolaridade::select('militar_id')
                    ->get()
                    ->toArray(),
            )
            ->where('situacao', 'ativa')
            ->join('postos', 'militars.posto_id', '=', 'postos.id')
            ->orderBy('antiguidade', 'ASC')
            ->orderBy('numero')
            ->count();
    }

    public static function getQtdMilitaresComEscolaridade()
    {
        return Militar::select('nome_de_guerra', 'numero', 'posto_id')
            ->whereIn(
                'militars.id',
                MilitarEscolaridade::select('militar_id')
                    ->get()
                    ->toArray(),
            )
            ->where('situacao', 'ativa')
            ->join('postos', 'militars.posto_id', '=', 'postos.id')
            ->orderBy('antiguidade', 'ASC')
            ->orderBy('numero')
            ->count();
    }

    public static function getPorcentagemMilitaresComEscolaridade()
    {
        $militares_com_escolaridade = Militar::select('nome_de_guerra', 'numero', 'posto_id')
            ->whereIn(
                'militars.id',
                MilitarEscolaridade::select('militar_id')
                    ->get()
                    ->toArray(),
            )
            ->where('situacao', 'ativa')
            ->join('postos', 'militars.posto_id', '=', 'postos.id')
            ->orderBy('antiguidade', 'ASC')
            ->orderBy('numero')
            ->count();
        $militares = Militar::where('situacao', 'ativa')->count();

        return round((100 * $militares_com_escolaridade) / $militares, 2);
    }

    public static function getPorcentagemMilitaresSemEscolaridade()
    {
        $militares_sem_escolaridade = Militar::select('nome_de_guerra', 'numero', 'posto_id')
            ->whereNotIn(
                'militars.id',
                MilitarEscolaridade::select('militar_id')
                    ->get()
                    ->toArray(),
            )
            ->where('situacao', 'ativa')
            ->join('postos', 'militars.posto_id', '=', 'postos.id')
            ->orderBy('antiguidade', 'ASC')
            ->orderBy('numero')
            ->count();
        $militares = Militar::where('situacao', 'ativa')->count();

        return round((100 * $militares_sem_escolaridade) / $militares, 2);
    }

    #taf

    public static function getMilitaresSemTaf($data_inicio, $data_final)
    {
        return Militar::select('nome_de_guerra', 'numero', 'posto_id')
            ->whereNotIn(
                'militars.id',
                Taf::select('militar_id')
                    ->whereBetween('created_at', [$data_inicio, $data_final])
                    ->get()
                    ->toArray(),
            )
            ->where('situacao', 'ativa')
            ->join('postos', 'militars.posto_id', '=', 'postos.id')
            ->orderBy('antiguidade', 'ASC')
            ->orderBy('numero')
            ->get();
    }

    public static function getMilitaresComTaf($data_inicio, $data_final)
    {
        return Militar::select('nome_de_guerra', 'numero', 'posto_id')
            ->whereIn(
                'militars.id',
                Taf::select('militar_id')
                    ->whereBetween('created_at', [$data_inicio, $data_final])
                    ->get()
                    ->toArray(),
            )
            ->where('situacao', 'ativa')
            ->join('postos', 'militars.posto_id', '=', 'postos.id')
            ->orderBy('antiguidade', 'ASC')
            ->orderBy('numero')
            ->get();
    }

    public static function getQtdMilitaresSemTaf($data_inicio, $data_final)
    {
        return Militar::select('nome_de_guerra', 'numero', 'posto_id')
            ->whereNotIn(
                'militars.id',
                Taf::select('militar_id')
                    ->whereBetween('created_at', [$data_inicio, $data_final])
                    ->get()
                    ->toArray(),
            )
            ->where('situacao', 'ativa')
            ->join('postos', 'militars.posto_id', '=', 'postos.id')
            ->orderBy('antiguidade', 'ASC')
            ->orderBy('numero')
            ->count();
    }

    public static function getQtdMilitaresComTaf($data_inicio, $data_final)
    {
        return Militar::select('nome_de_guerra', 'numero', 'posto_id')
            ->whereIn(
                'militars.id',
                Taf::select('militar_id')
                    ->whereBetween('created_at', [$data_inicio, $data_final])
                    ->get()
                    ->toArray(),
            )
            ->where('situacao', 'ativa')
            ->join('postos', 'militars.posto_id', '=', 'postos.id')
            ->orderBy('antiguidade', 'ASC')
            ->orderBy('numero')
            ->count();
    }

    public static function getPorcentagemMilitaresComTaf($data_inicio, $data_final)
    {
        $militares_com_taf = Militar::select('nome_de_guerra', 'numero', 'posto_id')
            ->whereIn(
                'militars.id',
                Taf::select('militar_id')
                    ->whereBetween('created_at', [$data_inicio, $data_final])
                    ->get()
                    ->toArray(),
            )
            ->where('situacao', 'ativa')
            ->join('postos', 'militars.posto_id', '=', 'postos.id')
            ->orderBy('antiguidade', 'ASC')
            ->orderBy('numero')
            ->count();
        $militares = Militar::where('situacao', 'ativa')->count();

        return round((100 * $militares_com_taf) / $militares, 2);
    }

    public static function getPorcentagemMilitaresSemTaf($data_inicio, $data_final)
    {
        $militares_sem_taf = Militar::select('nome_de_guerra', 'numero', 'posto_id')
            ->whereNotIn(
                'militars.id',
                Taf::select('militar_id')
                    ->whereBetween('created_at', [$data_inicio, $data_final])
                    ->get()
                    ->toArray(),
            )
            ->where('situacao', 'ativa')
            ->join('postos', 'militars.posto_id', '=', 'postos.id')
            ->orderBy('antiguidade', 'ASC')
            ->orderBy('numero')
            ->count();
        $militares = Militar::where('situacao', 'ativa')->count();

        return round((100 * $militares_sem_taf) / $militares, 2);
    }

    #avaliação

    public static function getMilitaresSemAvaliacao($data_inicio, $data_final)
    {
        return Militar::select('nome_de_guerra', 'numero', 'posto_id')
            ->whereNotIn(
                'militars.id',
                AvaliacaoMilitar::select('militar_id')
                    ->whereBetween('created_at', [$data_inicio, $data_final])
                    ->get()
                    ->toArray(),
            )
            ->where('situacao', 'ativa')
            ->join('postos', 'militars.posto_id', '=', 'postos.id')
            ->orderBy('antiguidade', 'ASC')
            ->orderBy('numero')
            ->get();
    }

    public static function getMilitaresComAvaliacao($data_inicio, $data_final)
    {
        return Militar::select('nome_de_guerra', 'numero', 'posto_id')
            ->whereIn(
                'militars.id',
                AvaliacaoMilitar::select('militar_id')
                    ->whereBetween('created_at', [$data_inicio, $data_final])
                    ->get()
                    ->toArray(),
            )
            ->where('situacao', 'ativa')
            ->join('postos', 'militars.posto_id', '=', 'postos.id')
            ->orderBy('antiguidade', 'ASC')
            ->orderBy('numero')
            ->get();
    }

    public static function getQtdMilitaresSemAvaliacao($data_inicio, $data_final)
    {
        return Militar::select('nome_de_guerra', 'numero', 'posto_id')
            ->whereNotIn(
                'militars.id',
                AvaliacaoMilitar::select('militar_id')
                    ->whereBetween('created_at', [$data_inicio, $data_final])
                    ->get()
                    ->toArray(),
            )
            ->where('situacao', 'ativa')
            ->join('postos', 'militars.posto_id', '=', 'postos.id')
            ->orderBy('antiguidade', 'ASC')
            ->orderBy('numero')
            ->orWhereIn(
                'militars.id',
                AvaliacaoMilitar::select('militar_id')
                    ->whereBetween('created_at', [$data_inicio, $data_final])
                    ->where('situacao', 1)
                    ->get()
                    ->toArray(),
            )
            ->count();
    }

    public static function getQtdMilitaresComAvaliacao($data_inicio, $data_final)
    {
        return Militar::select('nome_de_guerra', 'numero', 'posto_id')
            ->whereIn(
                'militars.id',
                AvaliacaoMilitar::select('militar_id')
                    ->whereBetween('created_at', [$data_inicio, $data_final])
                    ->get()
                    ->toArray(),
            )
            ->where('situacao', 'ativa')
            ->join('postos', 'militars.posto_id', '=', 'postos.id')
            ->orderBy('antiguidade', 'ASC')
            ->orderBy('numero')
            ->count();
    }

    public static function getPorcentagemMilitaresComAvaliacao($data_inicio, $data_final)
    {
        $militares_com_taf = Militar::select('nome_de_guerra', 'numero', 'posto_id')
            ->whereIn(
                'militars.id',
                AvaliacaoMilitar::select('militar_id')
                    ->whereBetween('created_at', [$data_inicio, $data_final])
                    ->where('situacao', 2)
                    ->get()
                    ->toArray(),
            )
            ->where('situacao', 'ativa')
            ->join('postos', 'militars.posto_id', '=', 'postos.id')
            ->orderBy('antiguidade', 'ASC')
            ->orderBy('numero')
            ->count();
        $militares = Militar::where('situacao', 'ativa')->count();

        return round((100 * $militares_com_taf) / $militares, 2);
    }

    public static function getPorcentagemMilitaresSemAvaliacao($data_inicio, $data_final)
    {
        $militares_sem_taf = Militar::select('nome_de_guerra', 'numero', 'posto_id')
            ->whereNotIn(
                'militars.id',
                AvaliacaoMilitar::select('militar_id')
                    ->whereBetween('created_at', [$data_inicio, $data_final])
                    ->get()
                    ->toArray(),
            )
            ->where('situacao', 'ativa')
            ->join('postos', 'militars.posto_id', '=', 'postos.id')
            ->orderBy('antiguidade', 'ASC')
            ->orderBy('numero')
            ->orWhereIn(
                'militars.id',
                AvaliacaoMilitar::select('militar_id')
                    ->whereBetween('created_at', [$data_inicio, $data_final])
                    ->where('situacao', 1)
                    ->get()
                    ->toArray(),
            )
            ->count();
        $militares = Militar::where('situacao', 'ativa')->count();

        return round((100 * $militares_sem_taf) / $militares, 2);
    }

}
