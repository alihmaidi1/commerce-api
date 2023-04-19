<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory,HasUuids;

    public $with=["currency"];

    public $fillable=["name","description","meta_logo","title","meta_title","meta_description","category_id","price","quantity","min_quantity","selling_number","currency_id","brand_id","thumbnail","copon_id"];

    public $hidden=["created_at","updated_at","brand_id","category_id","currency_id","copon_id","currency","pivot"];


    public function getPriceAttribute($value){


        $productCurrencyValue=$this->currency->value;
        $CurrencyUserValue=request()->currency->value;
        $priceInDular=$value/$productCurrencyValue;
        return $priceInDular*$CurrencyUserValue;

    }

    // public function getPropertiesAttribute(){


    //     return $this->properties()->get();

    // }
    public function getMetaLogoAttribute($value){

        $arr=[];
        $arr["200*300"]=public_path("product/v1/".$this->id."/".$value);
        $arr["500*700"]=public_path("product/v2/".$this->id."/".$value);
        $arr["1000*1200"]=public_path("product/v3/".$this->id."/".$value);

        return $arr;



    }


    public function getThumbnailAttribute($value){

        $arr=[];
        $arr["200*300"]=public_path("product/v1/".$this->id."/".$value);
        $arr["500*700"]=public_path("product/v2/".$this->id."/".$value);
        $arr["1000*1200"]=public_path("product/v3/".$this->id."/".$value);

        return $arr;



    }

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


        return $this->belongsToMany(property::class,property_product::class,"product_id","property_id")->withPivot("values")->using(property_product::class);
    }


    public function images(){


        return $this->morphMany(image::class,"imageable");

    }


    // public function getImagesAttribute(){

    //     return $this->images()->get();
    // }


    public function tags(){


        return $this->belongsToMany(tag::class,tag_product::class,"product_id","tag_id");

    }


    // public function getTagsAttribute(){

    //     return $this->tags()->get();
    // }

    public function copon(){

        return $this->belongsTo(copon::class,"copon_id");

    }




    public function carts(){

        return $this->hasMany(cart::class,"product_id");

    }


    public function reviews(){


        return $this->hasMany(review::class,"product_id");

    }
}
