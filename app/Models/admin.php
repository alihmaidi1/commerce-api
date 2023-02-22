<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class admin extends Authenticatable
{
    use HasFactory,HasUuids,HasApiTokens;

    public $fillable=["name","email","password","phone"];

    public $hidden=["created_at","updated_at","role_id","password"];


    public function role(){

        return $this->belongsTo(role::class,"role_id");
    }


}