<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MilitarCurso extends Model
{
    use HasFactory;

    protected $fillable = [
        'curso_id',
        'data_conclusao',
        'pontuando',
        'militar_id'];

    public function militar(){
        return $this->belongsTo(Militar::class);
    }

    public function curso(){
        return $this->belongsTo(Curso::class);
    }   

    public function getPontuacaoCurso(){
        if ($this->curso->horas >= 100) {
            return 1;
        } else {
            return ($this->curso->horas / 100);
        }        
    }
}
