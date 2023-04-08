<?php

namespace App\Services\chainOfResponsibility\addingProduct;

use App\Models\image;
use Closure;

class storeImages{

// Open MySql

    public function handle($request,Closure $next){


        $urls=$request->temp->removeImages($request->images);
        MoveFiles($urls,"temp","product",$request->product->id);
        $images=[];

        foreach($urls as $image){
            $images[]=["imageable_id"=>$request->product->id,"imageable_type"=>"App\\Models\\product","url"=>$image->url];
        }
        image::insert($images);

        return $next($request->product);


    }



}
