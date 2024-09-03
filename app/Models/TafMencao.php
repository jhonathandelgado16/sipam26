<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TafMencao extends Model
{
    use HasFactory;

    protected $fillable = ['mencao', 'pontos'];

    public static function getMencoesDoTaf($taf_numero_id, $publicacao_id)
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
        return TafMencao::whereIn(
            'id',
            Taf::select('taf_mencao_id')
                ->where('taf_numero_id', $taf_numero_id)
                ->where('publicacao_id', $publicacao_id)
                ->whereBetween('created_at', [$data_inicio, $data_final])
                ->groupBy('taf_mencao_id')
                ->get()
                ->toArray(),
        )->get();
    }
}
