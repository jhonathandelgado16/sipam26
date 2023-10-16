<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvaliacaoMilitar extends Model
{
    use HasFactory;

    protected $fillable = [
        'categoria_avaliacao_id',
        'militar_id',
        'nota_final',
        'user_id',
        'situacao'
    ];

    public function categoria_avaliacao(){
        return $this->belongsTo(CategoriaAvaliacao::class);
    }
    
    public function militar()
    {
        return $this->belongsTo(Militar::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
