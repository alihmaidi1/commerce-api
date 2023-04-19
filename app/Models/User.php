<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable  implements JWTSubject
{
    use HasApiTokens,  Notifiable,HasUuids;

    protected $fillable = ['name','email','password',"photo","point","provider_id","status","code"];


    public function provider(){

        return $this->belongsTo(provider::class,"provider_id");
    }


    protected $hidden = ['password',"code","created_at","updated_at","status","provider_id"];


    public function getJWTCustomClaims()
    {
        return [];
    }


    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function wishlist(){


        return $this->belongsToMany(product::class,wishlist::class);

    }


    public function carts(){


        return $this->hasMany(cart::class,"user_id");

    }


    public function reviews(){


        return $this->hasMany(review::class,"user_id");

    }


}