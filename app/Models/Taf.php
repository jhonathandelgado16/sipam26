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

    public static function getPublicacoesDeTaf($taf_numero_id, $subunidade_id = null)
    {
        switch (date('m')) {
            case date('m') > 3:
                $data_inicio = date((date('Y')).'-03-01');
                $data_final = date((date('Y')+1).'-03-01');
                break;  
            case date('m') <= 3:
                $data_inicio = date((date('Y')-1).'-03-01');
                $data_final = date((date('Y')).'-03-01');
                break;      
        }

        if ($subunidade_id == null) {
            return Publicacao::whereIn(
                'id',
                Taf::select('publicacao_id')
                    ->where('taf_numero_id', $taf_numero_id)
                    ->whereBetween('created_at', [$data_inicio, $data_final])
                    ->groupBy('publicacao_id')
                    ->get()
                    ->toArray(),
            )->get();
        }

        return Publicacao::whereIn(
            'id',
            Taf::select('publicacao_id')
                ->where('taf_numero_id', $taf_numero_id)
                ->whereBetween('tafs.created_at', [$data_inicio, $data_final])
                ->join('militars', 'tafs.militar_id', '=', 'militars.id')
                ->where('subunidade_id', $subunidade_id)
                ->groupBy('publicacao_id')
                ->get()
                ->toArray(),
        )->get();
    }

    public static function getTafPorPublicacoesMencao($publicacao_id, $taf_mencao_id, $subunidade_id = null)
    {
        switch (date('m')) {
            case date('m') >= 3:
                $data_inicio = date((date('Y')).'-03-01');
                $data_final = date((date('Y')+1).'-03-01');
                break;  
            case date('m') <= 3:
                $data_inicio = date((date('Y')-1).'-03-01');
                $data_final = date((date('Y')).'-03-01');
                break;      
        }
        
        if ($subunidade_id == null) {
            return Taf::whereBetween('tafs.created_at', [$data_inicio, $data_final])
            ->where('publicacao_id', $publicacao_id)
            ->where('taf_mencao_id', $taf_mencao_id)
            ->join('militars', 'tafs.militar_id', '=', 'militars.id')
            ->join('postos', 'militars.posto_id', '=', 'postos.id')
            ->orderBy('antiguidade', 'ASC')
            ->orderBy('numero', 'ASC')
            ->get();
        }

        return Taf::whereBetween('tafs.created_at', [$data_inicio, $data_final])
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
