<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class TafNumero extends Model
{
    use HasFactory;

    protected $fillable = ['numero'];

    public function getQtdMencoes($mencao)
    {
        
        $user_auth = Auth::user();
        $user = User::findOrFail($user_auth->id);

        if (Auth::user()->hasRole('Admin')) {

        $qtd = Taf::where('taf_mencao_id', TafMencao::where('mencao', strtoupper($mencao))->first()->id)
            ->where('taf_numero_id', $this->id)
            ->whereYear('created_at', date('Y'))
            ->count();

        } else {
            $qtd = Taf::where('taf_mencao_id', TafMencao::where('mencao', strtoupper($mencao))->first()->id)
            ->where('taf_numero_id', $this->id)
            ->whereYear('tafs.created_at', date('Y'))
            ->join('militars', 'tafs.militar_id', '=', 'militars.id')
            ->where('subunidade_id', $user->subunidade_id)
            ->count();
        }

        return $qtd;
    }
}
