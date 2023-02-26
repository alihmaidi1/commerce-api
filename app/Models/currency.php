<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class currency extends Model
{
    use HasFactory,HasUuids;



    public $fillable=["code","value","name"];

    public $hidden=["created_at","updated_at"];



    public function products(){


        return $this->hasMany(product::class,"currency_id");
    }

}