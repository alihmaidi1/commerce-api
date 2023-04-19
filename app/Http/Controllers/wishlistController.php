<?php

namespace App\Http\Controllers;

use App\Http\Requests\wishlist\delete;
use App\Services\repo\interfaces\wishlistInterface;
use Illuminate\Http\Request;
use App\Http\Requests\wishlist\store;
class wishlistController extends Controller
{

    public $wishlist;
    public function __construct(wishlistInterface $wishlist){

        $this->middleware(["auth:user"])->except(["index","show"]);
        $this->middleware("getCurrency")->except(["store","delete"]);

        $this->wishlist=$wishlist;

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $wishlist=auth("user")->user()->wishlist;
        return response()->json($wishlist);



    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(store $request)
    {

        $product_id=$request->product_id;
        $this->wishlist->store($product_id);
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(delete $request)
    {

        $product_id=$request->product_id;
        $this->wishlist->delete($product_id);

        return response()->json();

    }
}