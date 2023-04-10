<?php

namespace App\Services\repo\classes;

use App\Models\country as ModelsCountry;
use App\Services\repo\interfaces\countryInterface;
use Illuminate\Support\Facades\Cache;

class country implements countryInterface{



    public function store($name){


        $country=ModelsCountry::create([

            "name"=>$name

        ]);

        Cache::pull("countries");

        return $country;
    }


    public function update($country,$name){

        $country->name=$name;
        $country->save();
        Cache::pull("countries");
        return $country;
    }


    public function getAllCountry(){


        return Cache::rememberForever("countries",function(){


            return ModelsCountry::with("citys:id,name,country_id,price")->get();

        });
    }


    public function removeCountry($country){

        $country1=$country;
        $country->delete();
        Cache::pull("countries");
        return $country1;

    }

}
