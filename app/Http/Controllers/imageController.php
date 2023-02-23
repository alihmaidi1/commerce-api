<?php

namespace App\Http\Controllers;

use App\Http\Requests\image\uploadimage;
use App\Http\Requests\image\uploadimages;
use App\Services\repo\interfaces\tempInterface;
use Illuminate\Http\Request;

class imageController extends Controller
{

    public $temp;
    public function  __construct(tempInterface $temp){

        $this->temp=$temp;

    }

    public function uploadimage(uploadimage $request){

        $image=$request->file("image");
        $extension=$image->extension();
        $name=time().rand(100000,999999).".".$extension;
        storeResize($image,$name);
        $image=$this->temp->store($name);
        return response()->json($image);





    }


    public function uploadimages(uploadimages $request){

        $images=$request->images;
        return  response()->json(storeResizeImages($images,$this->temp));





    }


}
