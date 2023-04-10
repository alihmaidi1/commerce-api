<?php

namespace App\Services\repo\classes;

use App\Models\copon as ModelsCopon;
use App\Services\repo\interfaces\coponInterface;
use Illuminate\Support\Facades\Cache;

class copon implements coponInterface{


    public function store($name,$type,$value,$currency_id,$end_at){


        $copon=ModelsCopon::create([

            "name"=>$name,
            "type"=>$type,
            "value"=>$value,
            "currency_id"=>$currency_id,
            "end_at"=>$end_at

        ]);

        Cache::pull("copons");

        return $copon;




    }


    public function update($name,$type,$value,$currency_id,$end_at,$copon){

        $copon->name=$name;
        $copon->type=$type;
        $copon->value=$value;
        $copon->currency_id=$currency_id;
        $copon->end_at=$end_at;
        $copon->save();
        Cache::pull("copons");
        return $copon;



    }

    public function getAllCopon(){


        return Cache::rememberForever("copons",function(){

            return ModelsCopon::with("products")->get();

        });
    }

    public function deleteCopon($copon){


        Cache::pull("copons");
        $copon->delete();


    }


}