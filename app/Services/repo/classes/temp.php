<?php


namespace App\Services\repo\classes;

use App\Models\temp as ModelsTemp;
use App\Services\repo\interfaces\tempInterface;
use Illuminate\Support\Facades\DB;

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


    public function removeImages($images){

        $urls=DB::table("temps")->whereIn("id",$images)->select("url")->get();
        ModelsTemp::destroy($images);
        return $urls;


    }


}
