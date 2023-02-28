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

        $folder=($this->imageable_type=="App\\Models\\product")??"product";
        $arr=[];
        $arr["200*300"]=public_path($folder."/v1/".$this->imageable_id."/".$value);
        $arr["500*700"]=public_path($folder."/v2/".$this->imageable_id."/".$value);
        $arr["1000*1200"]=public_path($folder."/v3/".$this->imageable_id."/".$value);
        return $arr;


    }

}