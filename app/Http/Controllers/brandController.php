<?php

namespace App\Http\Controllers;

use App\Http\Requests\brand\store;
use App\Http\Requests\brand\update;
use App\Models\brand;
use App\Services\repo\interfaces\brandInterface;
use App\Services\repo\interfaces\tempInterface;

class brandController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public $brand;
     public $temp;
     public function __construct(brandInterface $brand,tempInterface $temp){

        $this->middleware(["auth:api","can:brand"])->except(["index","show"]);
        $this->middleware("checkCurrency")->only(["index","show","update"]);
        $this->brand=$brand;
        $this->temp=$temp;


     }
    public function index()
    {
        //

        return response()->json($this->brand->getAllbrand());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(store $request)
    {

        $name=$request->name;
        $image=$request->image_id;
        $url=$this->temp->remove($image)->getRawOriginal("url");
        MoveFile($url,"temp","brand");
        $brand=$this->brand->store($url,$name);
        return response()->json($brand);


    }

    /**
     * Display the specified resource.
     */
    public function show(brand $brand)
    {
        //

        return response()->json($brand);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(update $request, brand $brand)
    {

        $image=$request->image_id;
        $name=$request->name;
        $url=updateimage($image,$this->temp,"brand",$brand,"url");
        $banner=$this->brand->update($brand,$url,$name);
        return response()->json($banner);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(brand $brand)
    {

        $this->brand->deleteBrand($brand);
        return response()->json();

    }
}