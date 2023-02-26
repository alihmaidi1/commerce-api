<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class brand extends Model
{
    use HasFactory,HasUuids;

    public $fillable=["name","url"];

    public $hidden=["created_at","updated_at"];

    public function getUrlAttribute($value){

        $arr=[];
        $arr["200*300"]=public_path("brand/v1/".$value);
        $arr["500*700"]=public_path("brand/v2/".$value);
        $arr["1000*1200"]=public_path("brand/v3/".$value);
        return $arr;

    }

    public function products(){

        return $this->hasMany(product::class,"brand_id");
    }

}
