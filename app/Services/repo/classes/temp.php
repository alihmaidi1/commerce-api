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

    public function remove($id){


        $temp=ModelsTemp::findOrFail($id);
        $temp1=$temp;
        $temp->delete();

        return $temp1;

    }

    public function getTemp($id){

        return ModelsTemp::findOrFail($id);
    }


}
