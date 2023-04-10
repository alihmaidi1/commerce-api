<?php


namespace App\Services\repo\classes;

use App\Models\banner as ModelsBanner;
use App\Services\repo\interfaces\bannerInterface;
use Illuminate\Support\Facades\Cache;

class banner implements bannerInterface{

    public function store($url,$status,$rank,$link,$show){


        $banner=ModelsBanner::create([

            "url"=>$url,
            "status"=>$status,
            "rank"=>$rank,
            "link"=>$link,
            "show"=>$show,

        ]);
        Cache::pull("banners");
        return $banner;
    }

    public function update($banner,$url,$status,$rank,$link,$show){

        $banner->url=$url;
        $banner->status=$status;
        $banner->rank=$rank;
        $banner->link=$link;
        $banner->show=$show;
        $banner->save();
        Cache::pull("banners");
        return $banner;
    }

    public function getallbanner(){

        return Cache::rememberForever("banners",function(){

            return ModelsBanner::all();

        });
    }


    public function deleteBanner($banner){



        $url=$banner->getRawOriginal("url");
        deleteImage($url,"banner");
        Cache::pull("banners");
        return $banner->delete();



    }


}
