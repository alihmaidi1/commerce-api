<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory,HasUuids;
    public $fillable=["name","description","meta_logo","title","meta_title","meta_description","category_id","price","quantity","min_quantity","selling_number","currency_id","brand_id","thumbnail"];

    public $hidden=["created_at","updated_at","brand_id","category_id","currency_id"];
    public function brand(){

        return $this->belongsTo(brand::class,"brand_id");
    }

    public function currency(){

        return $this->belongsTo(currency::class,"currency_id");
    }


    public function category(){

        return $this->belongsTo(category::class,"category_id");

    }


    public function properties(){


        return $this->belongsToMany(property::class,property_product::class,"product_id","property_id");

    }


    public function images(){


        return $this->morphMany(image::class,"imageable");

    }




}