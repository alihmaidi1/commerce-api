<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class property extends Model
{
    use HasFactory,HasUuids;

    public $fillable=["name"];

    public $hidden=["created_at","updated_at"];


    public function products(){


        return $this->belongsToMany(product::class,property_product::class,"property_id","product_id")->using(property_product::class);

    }


}