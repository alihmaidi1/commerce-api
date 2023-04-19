<?php

namespace App\Services\repo\interfaces;

interface reviewInterface{




    public function store($product_id,$stars,$content);
    public function update($id,$content,$stars);
    public function delete($id);



}
