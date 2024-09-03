<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CnhMilitar extends Model
{
    use HasFactory;

    protected $fillable = [
        'cnh_categoria_id',
        'militar_id',
    ];

    public function cnh_categoria(){
        return $this->belongsTo(CnhCategoria::class);
    }
    
    public function militar()
    {
        return $this->belongsTo(Militar::class);
    }
}
