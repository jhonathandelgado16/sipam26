<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taf extends Model
{
    use HasFactory;

    protected $fillable = ['taf_mencao_id', 'militar_id', 'publicacao_id', 'taf_numero_id'];

    public function taf_mencao()
    {
        return $this->belongsTo(TafMencao::class);
    }

    public function taf_numero()
    {
        return $this->belongsTo(TafNumero::class);
    }

    public function militar()
    {
        return $this->belongsTo(Militar::class);
    }

    public function publicacao()
    {
        return $this->belongsTo(Publicacao::class);
    }

    public static function getPublicacoesDeTaf($ano, $taf_numero_id, $subunidade_id = null)
    {
        if ($subunidade_id == null) {
            return Publicacao::whereIn(
                'id',
                Taf::select('publicacao_id')
                    ->where('taf_numero_id', $taf_numero_id)
                    ->whereYear('tafs.created_at', $ano)
                    ->groupBy('publicacao_id')
                    ->get()
                    ->toArray(),
            )->get();
        }

        return Publicacao::whereIn(
            'id',
            Taf::select('publicacao_id')
                ->where('taf_numero_id', $taf_numero_id)
                ->whereYear('tafs.created_at', $ano)
                ->join('militars', 'tafs.militar_id', '=', 'militars.id')
                ->where('subunidade_id', $subunidade_id)
                ->groupBy('publicacao_id')
                ->get()
                ->toArray(),
        )->get();
    }

    public static function getTafPorPublicacoesMencao($ano, $publicacao_id, $taf_mencao_id, $subunidade_id = null)
    {
        if ($subunidade_id == null) {
            return Taf::whereYear('tafs.created_at', $ano)
            ->where('publicacao_id', $publicacao_id)
            ->where('taf_mencao_id', $taf_mencao_id)
            ->join('militars', 'tafs.militar_id', '=', 'militars.id')
            ->join('postos', 'militars.posto_id', '=', 'postos.id')
            ->orderBy('antiguidade', 'ASC')
            ->orderBy('numero', 'ASC')
            ->get();
        }

        return Taf::whereYear('tafs.created_at', $ano)
            ->where('publicacao_id', $publicacao_id)
            ->where('taf_mencao_id', $taf_mencao_id)
            ->join('militars', 'tafs.militar_id', '=', 'militars.id')
            ->join('postos', 'militars.posto_id', '=', 'postos.id')
            ->where('subunidade_id', $subunidade_id)
            ->orderBy('antiguidade', 'ASC')
            ->orderBy('numero', 'ASC')
            ->get();
    }
}
