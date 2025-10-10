<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prise extends Model
{
    public function shop(){
        return $this->belongsTo('App\Shop');
    }
}
