<?php

namespace App\Http\Controllers;

use App\Http\Requests\tag\store;
use App\Http\Requests\tag\update;
use App\Models\tag;
use App\Services\repo\interfaces\tagInterface;

class tagController extends Controller
{

    public $tag;

    public function __construct(tagInterface $tag){

        $this->middleware(["auth:api","can:tag"])->except(["index","show"]);
        $this->tag=$tag;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return response()->json($this->tag->getAllTag());


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



        return response()->json($this->tag->store($request->name));


    }

    /**
     * Display the specified resource.
     */
    public function show(tag $tag)
    {
        return response()->json($tag);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(tag $tag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(update $request, tag $tag)
    {

        return response()->json($this->tag->update($tag,$request->name));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(tag $tag)
    {

        $this->tag->deleteTag($tag);

        return response()->json();


    }
}