<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publicacao extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero',
        'tipo',
        'assunto',
        'data'
    ];

    public function getPublicacao(){
        return $this->tipo . ' nº '. $this->numero .' de '. $this->getData();
    }

    public function getData(){
        return date('d/m/Y', strtotime($this->data));
    }

    public function getPublicacaoCompleta(){
        return $this->tipo . ' nº '. $this->numero .' de '. $this->getData() . ', '. $this->assunto;
    }

    
}
