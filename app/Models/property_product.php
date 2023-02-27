<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class property_product extends Pivot
{
    use HasFactory;
    public $fillable=["product_id","property_id","values"];

    protected $table="property_products";
    public $hidden=["created_at","updated_at","product_id","property_id"];

    public function getValuesAttribute($value){


        return json_decode($value);

    }

}
