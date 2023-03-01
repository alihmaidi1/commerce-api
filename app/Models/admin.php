<?php

namespace App\Models;
use Tymon\JWTAuth\Contracts\JWTSubject;

use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class admin extends Authenticatable implements JWTSubject
{
    use HasFactory,HasUuids,HasApiTokens;

    public $appends=["role"];

    public $fillable=["name","email","password","phone","role_id"];

    public $hidden=["created_at","updated_at","role_id","password","code"];


    public function role(){

        return $this->belongsTo(role::class,"role_id");
    }


    public function getRoleAttribute(){


        return $this->role()->get();

    }
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

}