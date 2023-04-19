<?php

namespace App\Http\Controllers;

use App\Http\Requests\review\delete;
use App\Http\Requests\review\store;
use App\Http\Requests\review\update;
use App\Services\repo\interfaces\reviewInterface;
use Illuminate\Http\Request;

class reviewController extends Controller
{

    public $review;

    public function __construct(reviewInterface $review){


        $this->review=$review;


    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(store $request)
    {

        $product_id=$request->product_id;
        $stars=$request->stars;
        $content=$request->content;
        $review=$this->review->store($product_id,$stars,$content);

        return response()->json($review);

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

        $content=$request->content;
        $stars=$request->stars;
        $id=$request->id;
        $review=$this->review->update($id,$content,$stars);

        return response()->json();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(delete $request)
    {

        $id=$request->id;
        $this->review->delete($id);

        return response()->json();
    }
}
