<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class User extends Model
{
    public function evaluation()
    {
        return $this->hasMany(Evaluation::class);
    }

    public function mylist(){
        return $this->hasOne(Mylist::class);
    }

    public function mylistShops()
    {
        return $this->belongsToMany(Shop::class, 'mylists');
    }


}
