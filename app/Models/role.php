<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class role extends Model
{
    use HasFactory,HasUuids;

    public $fillable=["name","permissions"];


    public function admins(){

        return $this->hasMany(admin::class,"role_id");
    }

    public function getPermissionsAttribute($value){

        return json_decode($value);
    }


    public $hidden=["created_at","updated_at"];
}
