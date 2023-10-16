<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TafMencao extends Model
{
    use HasFactory;

    protected $fillable = [
        'mencao',
        'pontos'
    ];

    public static function getMencoesDoTaf($ano, $taf_numero_id, $publicacao_id){
        return TafMencao::whereIn('id', Taf::select('taf_mencao_id')->where('taf_numero_id', $taf_numero_id)->where('publicacao_id', $publicacao_id)->whereYear('created_at', $ano)->groupBy('taf_mencao_id')->get()->toArray())->get();
    }
}
