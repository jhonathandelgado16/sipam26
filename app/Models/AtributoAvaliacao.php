<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AtributoAvaliacao extends Model
{
    use HasFactory;

    protected $fillable = [
        'categoria_avaliacao_id',
        'atributo_id',
        'status',
    ];
}
