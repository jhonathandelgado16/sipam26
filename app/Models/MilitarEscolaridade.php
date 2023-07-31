<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MilitarEscolaridade extends Model
{
    use HasFactory;

    protected $fillable = [
        'escolaridade_id',
        'militar_id',
        'instituicao_ensino'];

    public function escolaridade(){
        return $this->belongsTo(Escolaridade::class);
    }
}
