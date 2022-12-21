<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vtunggakan extends Model
{
    use HasFactory;

    protected $primaryKey = 'np2';

    public $incrementing = false;

    protected $keyType = 'string';

    public function tagihans()
    {
        return $this->hasOne(Tagihan::class, 'np2', 'np2');
    }
}
