<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atributo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'categoria_atributo_id',
        'status',
    ];

    public function categoria_atributo(){
        return $this->belongsTo(CategoriaAtributo::class);
    }
}
