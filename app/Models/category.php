<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory,HasUuids;


    public $fillable=["name","status","rank","description","meta_description","meta_title","url","meta_logo","parent_id"];

    public $hidden=["created_at","updated_at","parent_id"];

    public function childs(){

        return $this->hasMany(category::class,"parent_id");

    }

    public static function  tree(){


        $allCategory=self::with("products")->get();
        $rootCategories=$allCategory->whereNull("parent_id");

        self::formatTree($rootCategories,$allCategory);
        return $rootCategories;

    }

    public static function getCategory($id){

        $rootCategories=self::tree();
        return self::formatGetTree($rootCategories,$id);

    }

    public static function formatGetTree($rootCategories,$id){


        foreach($rootCategories as $rootCategory){

            if($rootCategory->id==$id){

                return $rootCategory;
            }

            if($rootCategory->childs->count()!=0){


            $category=self::formatGetTree($rootCategory->childs,$id);
            if($category!=null){

                return $category;
            }

            }


        }
        return null;

    }





    public static function formatTree($categories,$allCategory){


        foreach($categories as $category){

            $category->childs=$allCategory->where("parent_id",$category->id)->values();

            if($category->childs->isNotEmpty()){

                self::formatTree($category->childs,$allCategory);

            }
        }


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