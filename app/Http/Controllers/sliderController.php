<?php

namespace App\Http\Controllers;

use App\Http\Requests\slider\store;
use App\Http\Requests\slider\update;
use App\Models\slider;
use App\Services\repo\interfaces\sliderInterface;
use App\Services\repo\interfaces\tempInterface;

class sliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public $slider;
     public $temp;
     public function __construct(sliderInterface $slider,tempInterface $temp){
        $this->middleware(["auth:api","can:slider"])->except(["index","show"]);
        $this->slider=$slider;
        $this->temp=$temp;
     }


    public function index()
    {

        return response()->json($this->slider->getAllSlider());
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(store $request)
    {

        $image_id=$request->image_id;
        $status=$request->status;
        $rank=$request->rank;
        $url=$this->temp->remove($image_id)->getRawOriginal("url");
        MoveFile($url,"temp","slider");
        $slider=$this->slider->store($url,$rank,$status);
        return response()->json($slider);





    }

    /**
     * Display the specified resource.
     */
    public function show(slider $slider)
    {

        return response()->json($slider);

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(update $request, slider $slider)
    {

        $image=$request->image_id;
        $rank=$request->rank;
        $status=$request->status;
        $url=updateimage($image,$this->temp,"slider",$slider,"url");
        $slider=$this->slider->update($slider,$url,$rank,$status);
        return response()->json($slider);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(slider $slider)
    {

        $this->slider->deleteSlider($slider);
        return response()->json();



    }
}
