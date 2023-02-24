<?php

namespace App\Http\Controllers;

use App\Http\Requests\slider\store;
use App\Http\Requests\slider\update;
use App\Models\slider;
use App\Services\repo\interfaces\sliderInterface;
use App\Services\repo\interfaces\tempInterface;
use Illuminate\Http\Request;

class sliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public $slider;
     public $temp;
     public function __construct(sliderInterface $slider,tempInterface $temp){

        $this->slider=$slider;
        $this->temp=$temp;
     }


    public function index()
    {

        return response()->json($this->slider->getAllSlider());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
     * Show the form for editing the specified resource.
     */
    public function edit(slider $slider)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(update $request, slider $slider)
    {

        $image=$request->image_id;
        $rank=$request->rank;
        $status=$request->status;
        $url=updateimage($image,$this->temp,"slider",$slider);
        $slider=$this->slider->update($slider,$url,$rank,$status);
        return $slider;

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
