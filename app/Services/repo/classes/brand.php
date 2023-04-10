<?php

namespace App\Services\repo\classes;

use App\Models\brand as ModelsBrand;
use App\Services\repo\interfaces\brandInterface;
use Illuminate\Support\Facades\Cache;

class brand implements brandInterface{


    public function store($url,$name){

        $brand=ModelsBrand::create([

            "name"=>$name,
            "url"=>$url

        ]);
        Cache::pull("brands");
        Cache::put("brand:".$brand->id,$brand);
        return $brand;

    }



    public function update($brand,$url,$name){

        $brand->url=$url;
        $brand->name=$name;
        $brand->save();
        Cache::pull("brands");
        Cache::put("brand:".$brand->id,$brand);
        return $brand;



    }

    public function getAllbrand(){

        return Cache::rememberForever("brands",function(){


            return ModelsBrand::with("products")->get();
        });
    }

    public function deleteBrand($brand){

        $url=$brand->getRawOriginal("url");
        deleteImage($url,"brand");
        return $brand->delete();


    }

}
