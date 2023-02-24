<?php

namespace App\Services\repo\classes;

use App\Models\category as ModelsCategory;
use App\Services\repo\interfaces\categoryInterface;
use Illuminate\Support\Facades\Cache;

class category implements categoryInterface{


    public function store($name,$status,$rank,$description,$meta_description,$meta_title,$url,$meta_logo){


        $category=ModelsCategory::create([

            "name"=>$name,
            "status"=>$status,
            "rank"=>$rank,
            "description"=>$description,
            "meta_description"=>$meta_description,
            "meta_title"=>$meta_title,
            "url"=>$url,
            "meta_logo"=>$meta_logo
        ]);
        Cache::pull("categories");
        Cache::put("category:".$category->id,$category);
        return $category;


    }


    public function update($category,$name,$status,$rank,$description,$meta_description,$meta_title,$url,$meta_logo){

        $category->name=$name;
        $category->status=$status;
        $category->rank=$rank;
        $category->description=$description;
        $category->meta_description=$meta_description;
        $category->meta_title=$meta_title;
        $category->url=$url;
        $category->meta_logo=$meta_logo;
        $category->save();
        Cache::pull("categories");
        Cache::put("category:".$category->id,$category);
        return $category;
    }

    public function getallcategory(){

        return Cache::rememberForever("categories",function(){

            return ModelsCategory::all();

        });
    }

    public function deletecategory($category){


        $url=$category->getRawOriginal("url");
        $meta_logo=$category->getRawOriginal("meta_logo");
        deleteImage($url,"category");
        deleteImage($meta_logo,"category");
        return $category->delete();





    }

}