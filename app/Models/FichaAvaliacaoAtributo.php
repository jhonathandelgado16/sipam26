<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FichaAvaliacaoAtributo extends Model
{
    use HasFactory;

    protected $fillable = [
        'cooperacao',
        'autoconfianca',
        'persistencia',
        'iniciativa',
        'coragem',
        'responsabilidade',
        'disciplina',
        'equilibrio_emocional',
        'entusiasmo_profissional',
        'matricula_cfc',
        'punicao_fase',
        'avaliacao_global',
        'militar_id'];

    public function militar(){
        return $this->belongsTo(Militar::class);
    }
}
