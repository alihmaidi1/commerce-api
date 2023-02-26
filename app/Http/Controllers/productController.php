<?php

namespace App\Http\Controllers;

use App\Http\Requests\product\store;
use App\Models\product;
use App\Services\repo\interfaces\productInterface;
use App\Services\repo\interfaces\tempInterface;
use Illuminate\Http\Request;

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


        $name=$request->name;
        $title=$request->title;
        $description=$request->description;
        $meta_title=$request->meta_title;
        $meta_description=$request->meta_description;
        $meta_logo=$request->meta_logo;
        $category_id=$request->category_id;
        $price=$request->price;
        $quantity=$request->quantity;
        $min_quantity=$request->min_quantity;
        $selling_number=$request->selling_number;
        $currency_id=$request->currency_id;
        $brand_id=$request->brand_id;
        $thumbnail=$request->thumbnail;
        $images=$request->images;
        $meta_logo=$this->temp->remove($meta_logo)->getRawOriginal("url");
        MoveFile($meta_logo,"temp","product");
        $thumbnail=$this->temp->remove($thumbnail)->getRawOriginal("url");
        MoveFile($thumbnail,"temp","product");
        $product=$this->product->store($name,$title,$description,$meta_title,$meta_description,$meta_logo,$category_id,$price,$quantity,$min_quantity,$currency_id,$brand_id,$thumbnail);

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
