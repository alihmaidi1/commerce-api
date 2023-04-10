<?php

namespace App\Http\Controllers;

use App\Http\Requests\product\store;
use App\Http\Requests\product\updateProduct;
use App\Models\product;
use App\Services\chainOfResponsibility\addingProduct\createProduct;
use App\Services\chainOfResponsibility\addingProduct\storeImages;
use App\Services\chainOfResponsibility\addingProduct\storeProperty;
use App\Services\chainOfResponsibility\addingProduct\storeTag;
use App\Services\chainOfResponsibility\updateProduct\updateImages;
use App\Services\chainOfResponsibility\updateProduct\updateProduct as UpdateProductUpdateProduct;
use App\Services\chainOfResponsibility\updateProduct\updateProperty;
use App\Services\chainOfResponsibility\updateProduct\updateTag;
use App\Services\repo\interfaces\productInterface;
use App\Services\repo\interfaces\tempInterface;
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
        $this->middleware("checkCurrency")->except("destroy");
        $this->product=$product;
        $this->temp=$temp;

    }
    public function index()
    {


        return response()->json($this->product->getAllProduct());

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

        $request->temp=$this->temp;
        $request->productModel=$this->product;
        $product=app(Pipeline::class)->send($request)->through([createProduct::class,storeProperty::class,storeTag::class,storeImages::class])
                ->then(function($product){return $product;});





        return response()->json($product);


    }

    /**
     * Display the specified resource.
     */
    public function show(product $product)
    {

        return response()->json($product);
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
    public function update(updateProduct $request, product $product)
    {

        $request->product=$product;
        $request->temp=$this->temp;
        $request->productModel=$this->product;

        $product=app(Pipeline::class)->send($request)->through([UpdateProductUpdateProduct::class,updateProperty::class,updateTag::class,updateImages::class])
            ->then(function($product){return $product;});

        return response()->json($product);

    }

    /**
     * Remove the specified resource from storage.
     */
     public function destroy(product $product)
    {
        $this->product->deleteProduct($product);
        return response()->json();

    }
}