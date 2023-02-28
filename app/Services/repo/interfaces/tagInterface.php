<?php

namespace App\Services\repo\interfaces;


interface tagInterface{



    public function store($name);
    public function update($tag,$name);
    public function getAllTag();
    public function deleteTag($tag);


}