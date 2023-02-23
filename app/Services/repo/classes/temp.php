<?php


namespace App\Services\repo\classes;

use App\Models\temp as ModelsTemp;
use App\Services\repo\interfaces\tempInterface;


class temp implements tempInterface{

    public function store($url){

        return ModelsTemp::create([

            "url"=>$url

        ]);
    }


}
