<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    public function shops()
    {
        return $this->hasMany(Shop::class);
    }
}
