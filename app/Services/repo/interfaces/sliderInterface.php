<?php

namespace App\Services\repo\interfaces;


interface sliderInterface{



    public function store($url,$rank,$status);
    public function update($slider,$url,$rank,$status);

    public function getAllSlider();
    public function deleteSlider($slider);


}
