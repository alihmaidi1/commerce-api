<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class image extends Model
{
    use HasFactory;
    public $fillable=["url","imageable_id","imageable_type"];
    public $hidden=["created_at","updated_at"];


    public function imageable(){

        return $this->morphTo();
    }


    public function getUrlAttribute($value){


        $arr=[];
        $arr["200*300"]=public_path("brand/v1/".$value);
        $arr["500*700"]=public_path("brand/v2/".$value);
        $arr["1000*1200"]=public_path("brand/v3/".$value);
        return $arr;


    }

}
