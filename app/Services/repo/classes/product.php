<?php

namespace App\Services\repo\classes;

use App\Models\product as ModelsProduct;
use App\Services\repo\interfaces\productInterface;
use Illuminate\Support\Facades\Cache;

class product implements productInterface{


    public function store($name,$title,$description,$meta_title,$meta_description,$meta_logo,$category_id,$price,$quantity,$min_quantity,$currency_id,$brand_id,$thumbnail){

        $product=ModelsProduct::create([

            "name"=>$name,
            "title"=>$title,
            "description"=>$description,
            "meta_title"=>$meta_title,
            "meta_description"=>$meta_description,
            "meta_logo"=>$meta_logo,
            "category_id"=>$category_id,
            "price"=>$price,
            "quantity"=>$quantity,
            "min_quantity"=>$min_quantity,
            "currency_id"=>$currency_id,
            "brand_id"=>$brand_id,
            "thumbnail"=>$thumbnail
        ]);
        Cache::pull("products");
        Cache::put("product:".$product->id,$product);

        return $product;

    }

    public function update($product,$name,$title,$description,$meta_title,$meta_description,$meta_logo,$category_id,$price,$quantity,$min_quantity,$currency_id,$brand_id,$thumbnail){


        $product->name=$name;
        $product->title=$title;
        $product->description=$description;
        $product->meta_title=$meta_title;
        $product->meta_description=$meta_description;
        $product->meta_logo=$meta_logo;
        $product->category_id=$category_id;
        $product->price=$price;
        $product->quantity=$quantity;
        $product->min_quantity=$min_quantity;
        $product->currency_id=$currency_id;
        $product->brand_id=$brand_id;
        $product->thumbnail=$thumbnail;
        $product->save();
        Cache::pull("products");
        Cache::put("product:".$product->id,$product);
        return $product;

    }


    public function getAllProduct(){


        return Cache::rememberForever("products",function(){


            return ModelsProduct::all();

        });
    }

    public function deleteProduct($product){

        // unlink(public_path("product/v1/".$product->getRawOriginal("")));
        // $product->properties()->dele




    }

}
