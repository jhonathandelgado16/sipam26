<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ranking extends Model
{
    use HasFactory;

    protected $fillable = [
        'militar_id',
        'nota_final',
        'nota_atitude',
        'nota_conhecimento',
        'nota_habilidade'
    ];

    public static function atualizarNotas($militar_id){
        $militar = Militar::find($militar_id);

        if(Ranking::where('militar_id', $militar_id)->first() == null){
            Ranking::create([
                'militar_id' => $militar_id,
                'nota_final' => $militar->getPontosMilitar(),
                'nota_atitude' => $militar->getPontosAtitude(),
                'nota_conhecimento' => $militar->getPontosConhecimento(),
                'nota_habilidade' => $militar->getPontosHabilidade()
            ]);
        } else {
            
            $ranking_militar = Ranking::where('militar_id', $militar_id)->first();
            $ranking_militar->nota_final = $militar->getPontosMilitar();
            $ranking_militar->nota_atitude = $militar->getPontosAtitude();
            $ranking_militar->nota_conhecimento = $militar->getPontosConhecimento();
            $ranking_militar->nota_habilidade = $militar->getPontosHabilidade();
            $ranking_militar->save();
        }
    }

    public function militar(){
        return $this->belongsTo(Militar::class);
    }
}
