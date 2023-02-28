<?php

namespace App\Services\chainOfResponsibility\addingProduct;

use Closure;

class createProduct{


    public function handle($request, Closure $next){

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
        $meta_logo=$request->temp->remove($meta_logo)->getRawOriginal("url");
        $thumbnail=$request->temp->remove($thumbnail)->getRawOriginal("url");
        $request->product=$request->productModel->store($name,$title,$description,$meta_title,$meta_description,$meta_logo,$category_id,$price,$quantity,$min_quantity,$currency_id,$brand_id,$thumbnail);
        makeDirectory("product",$request->product->id);
        MoveFile($meta_logo,"temp","product",$request->product->id);
        MoveFile($thumbnail,"temp","product",$request->product->id);
        return $next($request);









    }




}