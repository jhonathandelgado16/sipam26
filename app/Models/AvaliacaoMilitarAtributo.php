<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvaliacaoMilitarAtributo extends Model
{
    use HasFactory;

    protected $fillable = [
        'atributo_id',
        'militar_id',
        'nota',
        'user_id',
        'fase',
        'situacao'
    ];

    public function atributo(){
        return $this->belongsTo(Atributo::class);
    }
    
    public function militar()
    {
        return $this->belongsTo(Militar::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function getAtributosBasicos($militar_id, $situacao){
        return AvaliacaoMilitarAtributo::select('avaliacao_militar_atributos.id', 'militar_id', 'nota', 'atributo_id')->where('militar_id', $militar_id)->join('atributos', 'avaliacao_militar_atributos.atributo_id', 'atributos.id')->where('atributos.categoria_atributo_id', 2)->where('situacao', $situacao)->get();
    }

    public static function getAtributosFuncionais($militar_id, $situacao){
        return AvaliacaoMilitarAtributo::select('avaliacao_militar_atributos.id', 'militar_id', 'nota', 'atributo_id')->where('militar_id', $militar_id)->join('atributos', 'avaliacao_militar_atributos.atributo_id', 'atributos.id')->where('atributos.categoria_atributo_id', 1)->where('situacao', $situacao)->get();
    }

}
