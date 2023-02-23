<?php

namespace App\Http\Controllers;

use App\Http\Requests\currency\storeRequest;
use App\Http\Requests\currency\update;
use App\Models\currency;
use App\Services\repo\interfaces\currencyInterface;
use Illuminate\Http\Request;

class currencyController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public $currency;
    public function __construct(currencyInterface $currency){

        $this->middleware("auth:api")->except(["index","show"]);
        $this->currency=$currency;

    }
    public function index()
    {


        return response()->json($this->currency->getAllCurrency());


    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(storeRequest $request)
    {

        $name=$request->name;
        $code=$request->code;
        $value=$request->value;
        $currency=$this->currency->store($name,$code,$value);

        return response()->json($currency);



    }

    /**
     * Display the specified resource.
     */
    public function show(currency $currency)
    {


        return response()->json($currency);

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(update $request, $id)
    {

        $name=$request->name;
        $code=$request->code;
        $value=$request->value;
        $currency=$this->currency->update($id,$name,$code,$value);
        return response()->json($currency);



    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(currency $currency)
    {



        return response()->json($this->currency->deleteCurrency($currency));




    }
}