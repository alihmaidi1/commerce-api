<?php

namespace App\Http\Controllers;

use App\Http\Requests\cart\delete;
use App\Services\repo\interfaces\cartInterface;
use App\Http\Requests\cart\store;
use App\Http\Requests\cart\update;

class cartController extends Controller
{


    public $cart;

    public function __construct(cartInterface $cart){


        $this->middleware(["auth:user"]);
        $this->middleware("getCurrency")->except(["destroy","store"]);

        $this->cart=$cart;

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $carts=$this->cart->getAllItem();
        return response()->json($carts);


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(store $request)
    {

        $quantity=$request->quantity;
        $product_id=$request->product_id;
        $this->cart->store($quantity,$product_id);
        return response()->json();

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(update $request)
    {

        $product_id=$request->product_id;
        $quantity=$request->quantity;
        $this->cart->updateOrCreate($product_id,$quantity);

        return response()->json();


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(delete $request)
    {

        $this->cart->delete($request->id);

        return response()->json();



    }
}
