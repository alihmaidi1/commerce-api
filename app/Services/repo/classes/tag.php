<?php


namespace App\Services\repo\classes;

use App\Models\tag as ModelsTag;
use App\Services\repo\interfaces\tagInterface;
use Illuminate\Support\Facades\Cache;

class tag implements tagInterface{


    public function store($name){


        $tag= ModelsTag::create(["name"=>$name]);
        Cache::pull("tags");
        Cache::put("tag:".$tag->id,$tag);

        return $tag;
    }


    public function update($tag,$name){

        $tag->name=$name;
        $tag->save();
        Cache::pull("tags");
        Cache::put("tag:".$tag->id,$tag);

        return $tag;

    }

    public function getAllTag(){

        return Cache::rememberForever("tags",function(){

            return ModelsTag::all();
        });
    }


    public function deleteTag($tag){

        Cache::pull("tags");
        Cache::pull("tag:".$tag->id);
        $tag->delete();




    }



}