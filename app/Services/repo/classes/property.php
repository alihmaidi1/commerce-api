<?php

namespace App\Services\repo\classes;

use App\Models\property as ModelsProperty;
use App\Services\repo\interfaces\propertyInterface;
use Illuminate\Support\Facades\Cache;

class property implements propertyInterface{


    public function store($name){

        $property=ModelsProperty::create([

            "name"=>$name
        ]);
        Cache::pull("properties");
        Cache::put("property:".$property->id,$property);

        return $property;

    }


    public function update($property,$name){

        $property->name=$name;
        $property->save();
        Cache::pull("properties");
        Cache::put("property:".$property->id,$property);
        return $property;

    }

    public function getAllProperty(){

        return Cache::rememberForever("properties",function(){


            return ModelsProperty::all();

        });
    }


    public function deleteProperty($property){

        $property1=$property;
        $property->delete();
        Cache::pull("properties");
        Cache::pull("property:".$property1->id);
        return $property1;

    }

}
