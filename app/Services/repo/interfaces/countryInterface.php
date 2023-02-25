<?php

namespace App\Services\repo\interfaces;

interface countryInterface{



    public function store($name);
    public function update($country,$name);


    public function getAllCountry();
    public function removeCountry($country);

}
