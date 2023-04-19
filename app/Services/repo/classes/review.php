<?php


namespace App\Services\repo\classes;

use App\Models\review as ModelsReview;
use App\Services\repo\interfaces\reviewInterface;

class review implements reviewInterface{


    public function store($product_id,$stars,$content){


        return ModelsReview::create([

            "product_id"=>$product_id,
            "stars"=>$stars,
            "content"=>$content,
            "user_id"=>auth("user")->user()->id

        ]);

    }


    public function update($id,$content,$stars){

        return ModelsReview::where("id",$id)->update([


            "stars"=>$stars,
            "content"=>$content

        ]);

    }

    public function delete($id){


        return ModelsReview::where("id",$id)->delete();

    }

}
