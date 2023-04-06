<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'posto_id',
        'situacao'];

    public function posto(){
        return $this->belongsTo(Posto::class);
    }

    public function getMedico(){
        return $this->posto->posto .' '. $this->nome;
    }

}
