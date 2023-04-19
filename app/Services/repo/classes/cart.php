<?php

namespace App\Services\repo\classes;

use App\Models\cart as ModelsCart;
use App\Services\repo\interfaces\cartInterface;


class cart implements cartInterface{



    public function store($quantity,$product_id){



        ModelsCart::create([


            "quantity"=>$quantity,
            "product_id"=>$product_id,
            "user_id"=>auth("user")->user()->id

        ]);

    }



    public function updateOrCreate($product_id,$quantity){


        ModelsCart::updateOrCreate([

            "user_id"=>auth("user")->user()->id,
            "product_id"=>$product_id

        ],[

            "quantity"=>$quantity

        ]);



    }


    public function getAllItem(){


        return ModelsCart::with("product")->where("user_id",auth("user")->user()->id)->get();




    }


    public function delete($id){

        return ModelsCart::where("id",$id)->delete();
    }


}