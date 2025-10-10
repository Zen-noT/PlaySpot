<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mylist extends Model
{
   public function user(){
        return $this->hasOne(User::class);
   }

    // public function shop(){
    //       return $this->hasMany(Shop::class);
    // }
}
