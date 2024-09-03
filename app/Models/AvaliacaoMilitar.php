<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvaliacaoMilitar extends Model
{
    use HasFactory;

    protected $fillable = ['categoria_avaliacao_id', 'militar_id', 'nota_final', 'user_id', 'situacao'];

    public function categoria_avaliacao()
    {
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

    public static function getChFracaoDevendoAvaliacao()
    {
        return User::whereIn(
            'id',
            AvaliacaoMilitar::select('user_id')
                ->where('situacao', 1)
                ->get()
                ->toArray(),
        )
            ->orWhereNotIn(
                'id',
                AvaliacaoMilitar::select('user_id')
                    ->get()
                    ->toArray(),
            )
            ->orWhereIn(
                'id',
                Militar::select('fracaos.user_id')
                    ->whereNotIn(
                        'militars.id',
                        AvaliacaoMilitar::select('militar_id')
                            ->whereYear('created_at', date('Y'))
                            ->get()
                            ->toArray(),
                    )
                    ->join('postos', 'militars.posto_id', '=', 'postos.id')
                    ->orderBy('antiguidade', 'ASC')
                    ->orderBy('numero')
                    ->orWhereIn(
                        'militars.id',
                        AvaliacaoMilitar::select('militar_id')
                            ->whereYear('created_at', date('Y'))
                            ->where('situacao', 1)
                            ->get()
                            ->toArray(),
                    )->join('militares_fracaos', 'militars.id', '=', 'militares_fracaos.militar_id')
                    ->join('fracaos', 'fracaos.id', '=', 'militares_fracaos.fracao_id')->get()->toArray()
            )

            ->get();
    }
}
