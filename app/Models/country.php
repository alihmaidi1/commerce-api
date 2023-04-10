<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class country extends Model
{
    use HasFactory,HasUuids;
    public $fillable=["name"];

    // public $with=["citys"];

    public function citys(){

        return $this->hasMany(city::class,"country_id");
    }



    public $hidden=["created_at","updated_at"];


}