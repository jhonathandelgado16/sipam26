<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relatorios extends Model
{
    use HasFactory;

    public static function getMilitaresSemCursoReengajamento()
    {
        return Militar::select('nome_de_guerra', 'numero', 'posto_id')
            ->whereNotIn(
                'militars.id',
                MilitarCurso::select('militar_id')
                    ->where('pontuando', 1)
                    ->whereYear('data_conclusao', '=', date('Y'))
                    ->get()
                    ->toArray(),
            )
            ->join('postos', 'militars.posto_id', '=', 'postos.id')
            ->orderBy('antiguidade', 'ASC')
            ->orderBy('numero')
            ->get();
    }

    public static function getQtdMilitaresSemCursoReengajamento()
    {
        return Militar::select('nome_de_guerra', 'numero', 'posto_id')
            ->whereNotIn(
                'militars.id',
                MilitarCurso::select('militar_id')
                    ->where('pontuando', 1)
                    ->whereYear('data_conclusao', '=', date('Y'))
                    ->get()
                    ->toArray(),
            )
            ->join('postos', 'militars.posto_id', '=', 'postos.id')
            ->orderBy('antiguidade', 'ASC')
            ->orderBy('numero')
            ->count();
    }

    public static function getMilitaresComCursoReengajamento()
    {
        return Militar::select('nome_de_guerra', 'numero', 'posto_id')
            ->whereIn(
                'militars.id',
                MilitarCurso::select('militar_id')
                    ->where('pontuando', 1)
                    ->whereYear('data_conclusao', '=', date('Y'))
                    ->get()
                    ->toArray(),
            )
            ->join('postos', 'militars.posto_id', '=', 'postos.id')
            ->orderBy('antiguidade', 'ASC')
            ->orderBy('numero')
            ->get();
    }

    public static function getQtdMilitaresComCursoReengajamento()
    {
        return Militar::select('nome_de_guerra', 'numero', 'posto_id')
            ->whereIn(
                'militars.id',
                MilitarCurso::select('militar_id')
                    ->where('pontuando', 1)
                    ->whereYear('data_conclusao', '=', date('Y'))
                    ->get()
                    ->toArray(),
            )
            ->join('postos', 'militars.posto_id', '=', 'postos.id')
            ->orderBy('antiguidade', 'ASC')
            ->orderBy('numero')
            ->count();
    }

    public static function getPorcentagemMilitaresComCursoReengajamento()
    {
        $militares_com_curso = Militar::select('nome_de_guerra', 'numero', 'posto_id')
            ->whereIn(
                'militars.id',
                MilitarCurso::select('militar_id')
                    ->where('pontuando', 1)
                    ->whereYear('data_conclusao', '=', date('Y'))
                    ->get()
                    ->toArray(),
            )
            ->join('postos', 'militars.posto_id', '=', 'postos.id')
            ->orderBy('antiguidade', 'ASC')
            ->orderBy('numero')
            ->count();

        $militares = Militar::where('situacao', 'ativa')->count();

        return round((100 * $militares_com_curso) / $militares, 2);
    }

    public static function getPorcentagemMilitaresSemCursoReengajamento()
    {
        $militares_sem_curso = Militar::select('nome_de_guerra', 'numero', 'posto_id')
            ->whereNotIn(
                'militars.id',
                MilitarCurso::select('militar_id')
                    ->where('pontuando', 1)
                    ->whereYear('data_conclusao', '=', date('Y'))
                    ->get()
                    ->toArray(),
            )
            ->join('postos', 'militars.posto_id', '=', 'postos.id')
            ->orderBy('antiguidade', 'ASC')
            ->orderBy('numero')
            ->count();

        $militares = Militar::where('situacao', 'ativa')->count();

        return round((100 * $militares_sem_curso) / $militares, 2);
    }

    public static function getMilitaresSemCursoReengajamentoPdf(){
        $subunidades = Subunidade::all();

        $militares_por_subunidade = [];

        foreach ($subunidades as $subunidade) {
            $militares_por_subunidade[$subunidade->nome] =  Militar::select('nome_de_guerra', 'numero', 'posto_id')
            ->whereNotIn(
                'militars.id',
                MilitarCurso::select('militar_id')
                    ->where('pontuando', 1)
                    ->whereYear('data_conclusao', '=', date('Y'))
                    ->get()
                    ->toArray(),
            )
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
            ->join('postos', 'militars.posto_id', '=', 'postos.id')
            ->orderBy('antiguidade', 'ASC')
            ->orderBy('numero')
            ->count();
        $militares = Militar::where('situacao', 'ativa')->count();

        return round((100 * $militares_sem_escolaridade) / $militares, 2);
    }

    #taf

    public static function getMilitaresSemTaf()
    {
        return Militar::select('nome_de_guerra', 'numero', 'posto_id')
            ->whereNotIn(
                'militars.id',
                Taf::select('militar_id')
                    ->whereYear('created_at', date('Y'))
                    ->get()
                    ->toArray(),
            )
            ->join('postos', 'militars.posto_id', '=', 'postos.id')
            ->orderBy('antiguidade', 'ASC')
            ->orderBy('numero')
            ->get();
    }

    public static function getMilitaresComTaf()
    {
        return Militar::select('nome_de_guerra', 'numero', 'posto_id')
            ->whereIn(
                'militars.id',
                Taf::select('militar_id')
                    ->whereYear('created_at', date('Y'))
                    ->get()
                    ->toArray(),
            )
            ->join('postos', 'militars.posto_id', '=', 'postos.id')
            ->orderBy('antiguidade', 'ASC')
            ->orderBy('numero')
            ->get();
    }

    public static function getQtdMilitaresSemTaf()
    {
        return Militar::select('nome_de_guerra', 'numero', 'posto_id')
            ->whereNotIn(
                'militars.id',
                Taf::select('militar_id')
                    ->whereYear('created_at', date('Y'))
                    ->get()
                    ->toArray(),
            )
            ->join('postos', 'militars.posto_id', '=', 'postos.id')
            ->orderBy('antiguidade', 'ASC')
            ->orderBy('numero')
            ->count();
    }

    public static function getQtdMilitaresComTaf()
    {
        return Militar::select('nome_de_guerra', 'numero', 'posto_id')
            ->whereIn(
                'militars.id',
                Taf::select('militar_id')
                    ->whereYear('created_at', date('Y'))
                    ->get()
                    ->toArray(),
            )
            ->join('postos', 'militars.posto_id', '=', 'postos.id')
            ->orderBy('antiguidade', 'ASC')
            ->orderBy('numero')
            ->count();
    }

    public static function getPorcentagemMilitaresComTaf()
    {
        $militares_com_taf = Militar::select('nome_de_guerra', 'numero', 'posto_id')
            ->whereIn(
                'militars.id',
                Taf::select('militar_id')
                    ->whereYear('created_at', date('Y'))
                    ->get()
                    ->toArray(),
            )
            ->join('postos', 'militars.posto_id', '=', 'postos.id')
            ->orderBy('antiguidade', 'ASC')
            ->orderBy('numero')
            ->count();
        $militares = Militar::where('situacao', 'ativa')->count();

        return round((100 * $militares_com_taf) / $militares, 2);
    }

    public static function getPorcentagemMilitaresSemTaf()
    {
        $militares_sem_taf = Militar::select('nome_de_guerra', 'numero', 'posto_id')
            ->whereNotIn(
                'militars.id',
                Taf::select('militar_id')
                    ->whereYear('created_at', date('Y'))
                    ->get()
                    ->toArray(),
            )
            ->join('postos', 'militars.posto_id', '=', 'postos.id')
            ->orderBy('antiguidade', 'ASC')
            ->orderBy('numero')
            ->count();
        $militares = Militar::where('situacao', 'ativa')->count();

        return round((100 * $militares_sem_taf) / $militares, 2);
    }

}
