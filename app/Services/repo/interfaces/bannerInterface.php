<?php

namespace App\Services\repo\interfaces;

interface bannerInterface{


    public function store($url,$status,$rank,$link,$show);
    public function update($banner,$url,$status,$rank,$link,$show);

    public function getallbanner();

    public function deleteBanner($banner);

}