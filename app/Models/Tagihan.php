<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    use HasFactory;

    public function tunggakan()
    {
        return $this->belongsTo(Tunggakan::class, 'np2', 'np2');
    }
}
