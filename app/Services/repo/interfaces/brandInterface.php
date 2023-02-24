<?php

namespace App\Services\repo\interfaces;

interface brandInterface{




    public function store($url,$name);
    public function update($brand,$url,$name);
    public function getAllbrand();
    public function deleteBrand($brand);




}
