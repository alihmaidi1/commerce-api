<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class copon extends Model
{
    use HasFactory,HasUuids;

    public $fillable=["name","type","value","currency_id","end_at"];
    public $hidden=["created_at","updated_at","currency_id","currency"];

    public $with=["currency"];


    public function getPriceAttribute($value){

        if($this->type!="precent"){

        $productCurrencyValue=$this->currency->value;
        $CurrencyUserValue=request()->currency->value;
        $priceInDular=$value/$productCurrencyValue;
        return $priceInDular*$CurrencyUserValue;


        }


        return $value;


    }
    public function currency(){

        return $this->belongsTo(currency::class,"currency_id");


    }

    public function products(){

        return $this->hasMany(product::class,"copon_id");

    }


}