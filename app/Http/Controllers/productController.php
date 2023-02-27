<?php

namespace App\Http\Controllers;

use App\Http\Requests\product\store;
use App\Models\product;
use App\Services\chainOfResponsibility\createProduct;
use App\Services\chainOfResponsibility\storeProperty;
use App\Services\repo\interfaces\productInterface;
use App\Services\repo\interfaces\tempInterface;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;

class productController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public $product;
    public $temp;
    public function __construct(productInterface $product,tempInterface $temp){

        $this->middleware(["auth:api","can:product"])->except(["index","show"]);
        $this->product=$product;
        $this->temp=$temp;

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


        $product=app(Pipeline::class)->send($request)->through([createProduct::class,storeProperty::class])
                ->then(function($product){return $product;});



        // $urls=$this->temp->removeImages($images);
        // MoveFiles($urls,"temp","product");
        // $product->images()->sync($urls);



        return response()->json($product);


    }

    /**
     * Display the specified resource.
     */
    public function show(product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(product $product)
    {
        //
    }
}