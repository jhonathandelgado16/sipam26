<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MilitarVeiculo extends Model
{
    use HasFactory;

    protected $fillable = [
        'modelo',
        'placa',
        'ano',
        'cor',
        'documentacao',
        'pneus',
        'farois',
        'luzes_sinalizacao',
        'retrovisores',
        'triangulo_sinalizacao',
        'parabrisa_limpador',
        'capacete',
        'tipo_veiculo',
        'militar_id',
    ];

    public function militar(): BelongsTo {
        return $this->belongsTo(Militar::class);
    }
}
