<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObjetivoInstrucao extends Model
{
    use HasFactory;

    protected $fillable = [
        'identificacao',
        'materia',
        'referencia',
        'dentro_da_fiib'];

    public function getOII(){
        return $this->materia . ' '. $this->identificacao;
    }
}
