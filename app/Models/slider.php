<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class slider extends Model
{
    use HasFactory,HasUuids;

    public $fillable=["url","status","ranks"];


    public function getStatusAttribute($value){

        return ($value==1)?"active":"not active";
    }
    public function getUrlAttribute($value){

        $arr=[];
        $arr["200*300"]=public_path("slider/v1/".$value);
        $arr["500*700"]=public_path("slider/v2/".$value);
        $arr["1000*1200"]=public_path("slider/v3/".$value);

        return $arr;



    }




    public $hidden=["created_at","updated_at"];

}