<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FichaIndividualBasica extends Model
{
    use HasFactory;

    protected $fillable = [
        'padrao_minimo_atingido',
        'militar_id',
        'objetivo_instrucao_id'];

    public function militar(){
        return $this->belongsTo(Militar::class);
    }

    public function objetivo_instrucao(){
        return $this->belongsTo(ObjetivoInstrucao::class);
    }
}
