<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Waitingtime extends Model
{
    public function shop(){
        return $this->hasMany('App\Shop');
    }
}
