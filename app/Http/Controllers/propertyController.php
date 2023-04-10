<?php

namespace App\Http\Controllers;

use App\Http\Requests\property\store;
use App\Http\Requests\property\update;
use App\Models\property;
use App\Services\repo\interfaces\propertyInterface;

class propertyController extends Controller
{

    public $property;
    public function __construct(propertyInterface $property){

        $this->middleware(["auth:api","can:property"])->except(["index","show"]);
        $this->middleware("checkCurrency")->only(["update","show","index"]);
        $this->property=$property;

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return response()->json($this->property->getAllProperty());

    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(store $request)
    {

        $name=$request->name;
        $propertys=$this->property->store($name);
        return response()->json($propertys);




    }

    /**
     * Display the specified resource.
     */
    public function show(property $property)
    {


        return response()->json($property);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(update $request, property $property)
    {

        $name=$request->name;
        $property=$this->property->update($property,$name);
        return response()->json($property);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(property $property)
    {

        $this->property->deleteProperty($property);
        return response()->json();
    }
}