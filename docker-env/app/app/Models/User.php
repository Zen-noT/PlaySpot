<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Illuminate\Foundation\Auth\User as Authenticatable;
//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    //use HasApiTokens, HasFactory, Notifiable;
    use HasApiTokens, Notifiable;



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




    

    protected $hidden = ['password'];


}
