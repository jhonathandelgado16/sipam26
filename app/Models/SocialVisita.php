<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SocialVisita extends Model
{
    use HasFactory;

    protected $fillable = [
        'data',
        'relato',
        'militar_id'
    ];

    public function militar() :BelongsTo {
        return $this->belongsTo(Militar::class);
    }
}
