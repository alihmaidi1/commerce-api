<?php

namespace App\Services\repo\interfaces;

interface wishlistInterface{




    public function store($product_id);
    public function delete($product_id);


}