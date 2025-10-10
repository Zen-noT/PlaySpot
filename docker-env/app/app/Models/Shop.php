<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    public function evaluation(){
        return $this->hasMany(Evaluation::class);
    }
    
    // public function mylist(){
    //     return $this->belongsToMany(Mylist::class);
    // }



    public function businesshour(){
        return $this->hasMany(Businesshour::class);
    }

    public function price(){
        return $this->hasMany(Price::class);
    }

    public function freetime(){
        return $this->hasMany(Freetime::class);
    }

    public function waitingtime(){
        return $this->hasOne(Waitingtime::class);
    }
}
