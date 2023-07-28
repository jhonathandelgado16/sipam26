<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaAvaliacaoPosto extends Model
{
    use HasFactory;

    protected $fillable = [
        'categoria_avaliacao_id',
        'posto_id',
    ];
}
