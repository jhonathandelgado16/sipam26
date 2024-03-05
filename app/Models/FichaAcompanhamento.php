<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Date;

class FichaAcompanhamento extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome_esposa',
        'contato_esposa',
        'nome_pai',
        'contato_pai',
        'nome_mae',
        'contato_mae',
        'acidentes_atividades_militares',
        'acidentes_atividades_militares_bi',
        'acidentes_automobilisticos',
        'acidentes_automobilisticos_bi',
        'acidentes_motociclisticos',
        'acidentes_motociclisticos_bi',
        'possui_cnh',
        'categoria_cnh',
        'conducao_motocicleta',
        'qtd_irmaos',
        'renda_familiar',
        'objetivo de vida',
        'lazer',
        'militar_id',
    ];

    public function militar() :BelongsTo {
        return $this->belongsTo(Militar::class);
    }

    public function getNumeroBiAtividadesMilitares() : string {
        if ($this->acidentes_atividades_militares_bi == null) {
            return "";
        }
        $array = explode(' ', $this->acidentes_atividades_militares_bi);
        return $array[2];
    }

    public function getDataBiAtividadesMilitares()  {
        if ($this->acidentes_atividades_militares_bi == null) {
            return "";
        }
        $array = explode(' ', $this->acidentes_atividades_militares_bi);
        return date('Y-m-d', strtotime($array[5]));
    }

    public function getNumeroBiAutomobilisticos() : string {
        if ($this->acidentes_automobilisticos_bi == null) {
            return "";
        }
        $array = explode(' ', $this->acidentes_automobilisticos_bi);
        return $array[2];
    }

    public function getDataBiAutomobilisticos()  {
        if ($this->acidentes_automobilisticos_bi == null) {
            return "";
        }
        $array = explode(' ', $this->acidentes_automobilisticos_bi);
        return date('Y-m-d', strtotime($array[5]));
    }

    public function getNumeroBiMotociclisticos() : string {
        if ($this->acidentes_motociclisticos_bi == null) {
            return "";
        }
        $array = explode(' ', $this->acidentes_motociclisticos_bi);
        return $array[2];
    }

    public function getDataBiMotociclisticos()  {
        if ($this->acidentes_motociclisticos_bi == null) {
            return "";
        }
        $array = explode(' ', $this->acidentes_motociclisticos_bi);
        return date('Y-m-d', strtotime($array[5]));
    }
}
