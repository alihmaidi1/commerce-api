<?php


namespace App\Services\repo\classes;

use App\Models\city as ModelsCity;
use App\Services\repo\interfaces\cityInterface;
use Illuminate\Support\Facades\Cache;

class city implements cityInterface{

    public function store($name,$country_id,$price,$currency_id)
    {


        $city=ModelsCity::create([

            "name"=>$name,
            "country_id"=>$country_id,
            "price"=>$price,
            "currency_id"=>$currency_id

        ]);
        Cache::pull("citys");
        Cache::put("city:".$city->id,$city);
        return $city;
    }

    public function update($city,$name,$country_id,$price,$currency_id){


        $city->name=$name;
        $city->price=$price;
        $city->currency_id=$currency_id;
        $city->country_id=$country_id;
        $city->save();
        Cache::pull("citys");
        Cache::put("city:".$city->id,$city);
        return $city;



    }

    public function removeCity($city){

        $city1=$city;
        $city->delete();
        Cache::pull("citys");
        Cache::pull("city:".$city->id);
        return response()->json($city1);


    }


}
