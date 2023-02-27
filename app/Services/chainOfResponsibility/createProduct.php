<?php

namespace App\Services\chainOfResponsibility;

use App\Services\repo\interfaces\productInterface;
use App\Services\repo\interfaces\tempInterface;
use Closure;

class createProduct{

    // public $temp;
    // public $product;
    // public function __construct(tempInterface $temp,productInterface $product){


    //     $this->temp=$temp;
    //     $this->product=$product;

    // }

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
        MoveFile($meta_logo,"temp","product");
        $thumbnail=$request->temp->remove($thumbnail)->getRawOriginal("url");
        MoveFile($thumbnail,"temp","product");
        $request->product=$request->productModel->store($name,$title,$description,$meta_title,$meta_description,$meta_logo,$category_id,$price,$quantity,$min_quantity,$currency_id,$brand_id,$thumbnail);
        return $next($request);














    }




}
