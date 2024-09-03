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
        switch (date('m')) {
            case date('m') > 3:
                $data_inicio = date((date('Y')).'-03-01');
                $data_final = date((date('Y')+1).'-03-01');
                break;  
            case date('m') <= 3:
                $data_inicio = date((date('Y')-1).'-03-01');
                $data_final = date((date('Y')).'-03-01');
                break;      
        }
        
        $user_auth = Auth::user();
        $user = User::findOrFail($user_auth->id);

        if (Auth::user()->hasRole('Admin')) {

        $qtd = Taf::where('taf_mencao_id', TafMencao::where('mencao', strtoupper($mencao))->first()->id)
            ->where('taf_numero_id', $this->id)
            ->whereBetween('tafs.created_at', [$data_inicio, $data_final])
            ->count();

        } else {
            $qtd = Taf::where('taf_mencao_id', TafMencao::where('mencao', strtoupper($mencao))->first()->id)
            ->where('taf_numero_id', $this->id)
            ->whereBetween('tafs.created_at', [$data_inicio, $data_final])
            ->join('militars', 'tafs.militar_id', '=', 'militars.id')
            ->where('subunidade_id', $user->subunidade_id)
            ->count();
        }

        return $qtd;
    }
}
