<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory,HasUuids;

    public $fillable=["name","status","rank","description","meta_description","meta_title","url","meta_logo","parent_id","parent_id"];

    public $hidden=["created_at","updated_at"];

    public function childs(){

        return $this->hasMany(category::class,"parent_id");

    }


    public function parent(){

        return $this->belongsTo(category::class,"parent_id");

    }


    public function getStatusAttribute($value){

        return ($value==0)?"active":"not active";


    }

    public function getUrlAttribute($value){

        $arr=[];
        $arr["200*300"]=public_path("category/v1/".$value);
        $arr["500*700"]=public_path("category/v2/".$value);
        $arr["1000*1200"]=public_path("category/v3/".$value);

        return $arr;

    }


    public function getMetaLogoAttribute($value){

        $arr=[];
        $arr["200*300"]=public_path("category/v1/".$value);
        $arr["500*700"]=public_path("category/v2/".$value);
        $arr["1000*1200"]=public_path("category/v3/".$value);

        return $arr;

    }



    public function products(){


        return $this->hasMany(product::class,"category_id");
    }



}
