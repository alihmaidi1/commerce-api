<?php

namespace App\Services\chainOfResponsibility;

use App\Models\image;
use Closure;

class storeImages{



    public function handle($request,Closure $next){


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
