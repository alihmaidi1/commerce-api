<?php

namespace App\Services\repo\classes;

use App\Models\page as ModelsPage;
use App\Services\repo\interfaces\pageInterface;
use Illuminate\Support\Facades\Cache;

class page implements pageInterface{


    public function store($content,$url){

        $page=ModelsPage::create([

            "content"=>$content,
            "url"=>$url
        ]);
        Cache::pull("pages");
        return $page;



    }


    public function update($content,$url,$page){

        $page->content=$content;
        $page->url=$url;
        $page->save();
        Cache::pull("pages");
        return $page;

    }


    public function getAllPage(){


        return Cache::rememberForever("pages",function(){

            return ModelsPage::all();

        });

    }


    public function delete($page){

        $page->delete();
    }

}