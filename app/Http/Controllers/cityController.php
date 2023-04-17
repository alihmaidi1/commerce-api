<?php

namespace App\Http\Controllers;

use App\Http\Requests\city\store;
use App\Http\Requests\city\update;
use App\Models\city;
use App\Services\repo\interfaces\cityInterface;

class cityController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public $city;
     public function __construct(cityInterface $city){

        $this->middleware("getCurrency")->only(["store","update"]);
        $this->city=$city;

     }
    public function index()
    {
        //
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

        $name=$request->name;
        $price=$request->price;
        $currency_id=$request->currency_id;
        $country_id=$request->country_id;
        $city=$this->city->store($name,$country_id,$price,$currency_id);
        return response()->json($city);


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(update $request, city $city)
    {

        $name=$request->name;
        $price=$request->price;
        $currency_id=$request->currency_id;
        $country_id=$request->country_id;
        $city=$this->city->update($city,$name,$country_id,$price,$currency_id);
        return response()->json($city);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(city $city)
    {

        $this->city->removeCity($city);
        return response()->json();




    }
}
