<?php

namespace App\Services\repo\interfaces;


interface propertyInterface{



    public function store($name);
    public function update($property,$name);

    public function getAllProperty();

    public function deleteProperty($property);

}
