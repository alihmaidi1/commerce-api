<?php


namespace App\Services\chainOfResponsibility\updateProduct;

use Closure;

class updateProduct{



    public function handle($request,Closure $next){


        $name=$request->name;
        $title=$request->title;
        $description=$request->description;
        $meta_title=$request->meta_title;
        $meta_description=$request->meta_description;
        $meta_logo=$request->meta_logo;
        $category_id=$request->category_id;
        $price=$request->price;
        $quantity=$request->quantity;
        $min_quantity=$request->min_quantity;
        $currency_id=$request->currency_id;
        $brand_id=$request->brand_id;
        $thumbnail=$request->thumbnail;
        $meta_logo=updateimage($meta_logo,$request->temp,"product",$request->product,"meta_logo");
        $thumbnail=updateimage($thumbnail,$request->temp,"product",$request->product,"thumbnail");
        $request->product=$request->productModel->update($request->product,$name,$title,$description,$meta_title,$meta_description,$meta_logo,$category_id,$price,$quantity,$min_quantity,$currency_id,$brand_id,$thumbnail);
        return $next($request);






    }



}