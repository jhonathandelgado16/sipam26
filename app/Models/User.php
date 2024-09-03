<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array

     */
    protected $fillable = ['name', 'email', 'password', 'subunidade_id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array

     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * The attributes that should be cast.
     *
     * @var array

     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function subunidade()
    {
        return $this->belongsTo(Subunidade::class);
    }

    public function getMilitaresSemAvaliacao()
    {
        return Militar::whereIn(
            'id',
                MilitaresFracao::select('militar_id')
                    ->join('fracaos', 'militares_fracaos.fracao_id', 'fracaos.id')
                    ->where('user_id', $this->id)
                    ->whereNotIn('militar_id',
                        AvaliacaoMilitar::select('militar_id')->get()->toArray()
                    )
                    ->get()
                    ->toArray(),
        )->orWhereIn(
            'id',
            AvaliacaoMilitar::select('militar_id')
                ->where('user_id', $this->id)
                ->where('situacao', 1)
                ->get()
                ->toArray(),
        )->get();
    }
}
