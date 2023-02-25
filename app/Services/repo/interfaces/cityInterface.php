<?php

namespace App\Services\repo\interfaces;

interface cityInterface{



    public function store($name,$country_id);
    public function update($city,$name,$country_id);
    public function removeCity($city);

}