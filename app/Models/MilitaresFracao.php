<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MilitaresFracao extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'militar_id',
        'fracao_id'];

    public function militar(){
        return $this->belongsTo(Militar::class);
    }

    public function fracao(){
        return $this->belongsTo(Fracao::class);
    }

}
