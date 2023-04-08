<?php

namespace App\Services\repo\interfaces;


interface pageInterface{



    public function store($content,$url);
    public function update($content,$url,$page);

    public function getAllPage();
    public function delete($page);

}