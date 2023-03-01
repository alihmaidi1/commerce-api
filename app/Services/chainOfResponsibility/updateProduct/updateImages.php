<?php


namespace App\Services\chainOfResponsibility\updateProduct;

use App\Models\image;
use Closure;

class updateImages{



    public function handle($request,Closure $next){

        image::destroy($request->deleted_image);
        $urls=$request->temp->removeImages($request->images);
        MoveFiles($urls,"temp","product",$request->product->id);
        $images=[];

        foreach($urls as $image){
            $images[]=["imageable_id"=>$request->product->it,"imageable_type"=>"App\\Models\\product","url"=>$image->url];
        }
        image::insert($images);

        return $next($request->product);





    }



}
