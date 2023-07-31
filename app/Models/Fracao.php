<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fracao extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'user_id',
        'status'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getMilitarResponsavel(){
        return User::find($this->user_id)->name;
    }

    public function getQtdMilitares(){
        $militares = MilitaresFracao::where('fracao_id', $this->id)->get();
        return $militares->count();
    }
}
