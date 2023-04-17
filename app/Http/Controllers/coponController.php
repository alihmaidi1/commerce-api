<?php

namespace App\Http\Controllers;

use App\Http\Requests\copon\store;
use App\Http\Requests\copon\update;
use App\Models\copon;
use App\Services\repo\interfaces\coponInterface;

class coponController extends Controller
{

    public $copon;
    public function __construct(coponInterface $copon){

        $this->middleware("getCurrency")->except("destroy");
        $this->copon=$copon;

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        return response()->json($this->copon->getAllCopon(),200);


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(store $request)
    {
        $name=$request->name;
        $type=$request->type;
        $value=$request->value;
        $end_at=$request->end_at;
        $currency_id=$request->currency_id;
        $copon=$this->copon->store($name,$type,$value,$currency_id,$end_at);

        return response()->json($copon,200);
    }

    /**
     * Display the specified resource.
     */
    public function show(copon $copon)
    {
        return response()->json($copon,200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(update $request, copon $copon)
    {


        $name=$request->name;
        $type=$request->type;
        $value=$request->value;
        $end_at=$request->end_at;
        $currency_id=$request->currency_id;
        $copon=$this->copon->update($name,$type,$value,$currency_id,$end_at,$copon);
        return response()->json($copon,200);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(copon $copon)
    {

        $this->copon->deleteCopon($copon);
        return response()->json();
    }
}