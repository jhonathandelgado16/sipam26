<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CursoFormacaoMilitar extends Model
{
    use HasFactory;

    protected $fillable = [
        'curso_formacao_id',
        'militar_id',
        'publicacao_id'
    ];

    public function curso_formacao(){
        return $this->belongsTo(CursoFormacao::class);
    }
    
    public function militar()
    {
        return $this->belongsTo(Militar::class);
    }

    public function publicacao()
    {
        return $this->belongsTo(Publicacao::class);
    }

}
