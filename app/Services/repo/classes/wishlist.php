<?php


namespace App\Services\repo\classes;

use App\Models\wishlist as ModelsWishlist;
use App\Services\repo\interfaces\wishlistInterface;

class wishlist implements wishlistInterface{



    public function store($product_id){


        ModelsWishlist::create([

            "product_id"=>$product_id,
            "user_id"=>auth("user")->user()->id

        ]);

    }

    public function delete($product_id){

        ModelsWishlist::where("product_id",$product_id)->where("user_id",auth("user")->user()->id)->delete();

    }

}
