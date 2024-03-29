<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class city extends Model
{
    use HasFactory,HasUuids;
    public $with=["currency"];
    public $fillable=["name","country_id","price","currency_id"];
    // public $appends=["currency","country"];

    public $hidden=["created_at","updated_at","country_id","currency_id","currency"];



    public function getPriceAttribute($value){



        $productCurrencyValue=$this->currency->value;
        $CurrencyUserValue=request()->currency->value;
        $priceInDular=$value/$productCurrencyValue;
        return $priceInDular*$CurrencyUserValue;


    }
    // public function getCurrencyAttribute(){


    //     return $this->currency()->first();

    // }


    // public function getCountryAttribute(){


    //     return $this->country()->without("citys")->first();

    // }

    public function country(){

        return $this->belongsTo(country::class,"country_id");
    }



    public function currency(){

        return $this->belongsTo(currency::class,"currency_id");
    }



}