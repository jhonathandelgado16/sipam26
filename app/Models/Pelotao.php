<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelotao extends Model
{
    use HasFactory;

    protected $fillable = [
        'pelotao',
        'cmt_pelotao',
        'subunidade_id'
    ];

    public function subunidade(){
        return $this->belongsTo(Subunidade::class);
    }
}
