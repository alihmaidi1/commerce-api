<?php


namespace App\Services\chainOfResponsibility\updateProduct;

use App\Models\image;
use Closure;

class updateImages{



    public function handle($request,Closure $next){


        image::destroy($request->deleted_image);
        $urls=$request->temp->removeImages($request->images);
        MoveFiles($urls,"temp","product");
        $images=[];

        foreach($urls as $url){

            $images[]=["imageable_id"=>$request->product->id,"imageable_type"=>"App\\Models\\product","url"=>"product/".$url->url];

        }
        image::insert($images);

        return $next($request->product);



    }



}