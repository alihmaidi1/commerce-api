<?php

namespace App\Services\repo\classes;

use App\Models\slider as ModelsSlider;
use App\Services\repo\interfaces\sliderInterface;
use Illuminate\Support\Facades\Cache;

class slider implements sliderInterface{



    public function store($url,$rank,$status){


        $slider=ModelsSlider::create([

            "url"=>$url,
            "ranks"=>$rank,
            "status"=>$status

        ]);

        Cache::pull("sliders");

        return $slider;

    }






    public function update($slider,$url,$rank,$status){

        $slider->url=$url;
        $slider->ranks=$rank;
        $slider->status=$status;
        $slider->save();
        Cache::pull("sliders");

        return $slider;

    }


    public function getAllSlider(){

        return Cache::rememberForever("sliders",function(){

            return ModelsSlider::all();
        });
    }

    public function deleteSlider($slider){



        $url=$slider->getRawOriginal("url");
        deleteImage($url,"slider");
        Cache::pull("sliders");
        return $slider->delete();

    }


}
