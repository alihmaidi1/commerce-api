<?php

namespace App\Services\repo\interfaces;

interface cartInterface{



    public function store($quantity,$product_id);

    public function updateOrCreate($product_id,$quantity);
    public function getAllItem();


    public function delete($id);


}