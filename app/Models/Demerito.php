<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demerito extends Model
{
    use HasFactory;

    protected $fillable = [
        'descricao',
        'pontos_demerito',
        'posto_id'
    ];
}
