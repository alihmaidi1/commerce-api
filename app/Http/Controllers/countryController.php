<?php

namespace App\Http\Controllers;

use App\Http\Requests\country\store;
use App\Http\Requests\country\update;
use App\Models\country;
use App\Services\repo\interfaces\countryInterface;

class countryController extends Controller
{
    /**
     * Display a listing of the resource.
     */


     public $country;
     public function __construct(countryInterface $country){


        $this->middleware(["auth:api","can:country"])->except(["index","show"]);
        $this->middleware("checkCurrency")->only(["update","show","index"]);
        $this->country=$country;

     }
    public function index()
    {
        return response()->json($this->country->getAllCountry());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(store $request)
    {

        $name=$request->name;
        $country=$this->country->store($name);
        return response()->json($country);


    }

    /**
     * Display the specified resource.
     */
    public function show(country $country)
    {
        return response()->json($country);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(update $request, country $country)
    {

        $name=$request->name;
        $country=$this->country->update($country,$name);
        return response()->json($country);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(country $country)
    {
        $this->country->removeCountry($country);
        return response()->json();

    }
}