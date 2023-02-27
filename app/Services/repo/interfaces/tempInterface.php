<?php


namespace App\Services\repo\interfaces;

interface tempInterface {


    public function store($url);

    public function remove($id);

    public function getTemp($id);

    public function removeImages($images);

}
