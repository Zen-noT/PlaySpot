<?php

namespace App\Models;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'profile', 'icon', 'role',
    ];

    protected $hidden = ['password'];

    public function isStore()
    {
        return $this->role == '0';
    }

    public function isUser()
    {
        return $this->role == '1';
    }




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
