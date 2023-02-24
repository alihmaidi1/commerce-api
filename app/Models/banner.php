<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class banner extends Model
{
    use HasFactory,HasUuids;

    public $fillable=["url","link","status","rank","show"];

    public $hidden=["created_at","updated_at"];

    public function getShowAttribute($value){


        if($value==0){

            return "show in header";
        }else if($value==1){

            return "show in body";
        }else{

            return "show in footer";
        }


    }


    public function getStatusAttribute($value){

        return ($value==1)?"active":"not active";
    }
    public function getUrlAttribute($value){

        $arr=[];
        $arr["200*300"]=public_path("banner/v1/".$value);
        $arr["500*700"]=public_path("banner/v2/".$value);
        $arr["1000*1200"]=public_path("banner/v3/".$value);

        return $arr;

    }


}
