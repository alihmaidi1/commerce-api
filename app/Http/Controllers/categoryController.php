<?php

namespace App\Http\Controllers;

use App\Http\Requests\category\store;
use App\Http\Requests\category\update;
use App\Models\category;
use App\Services\repo\interfaces\categoryInterface;
use App\Services\repo\interfaces\tempInterface;
use Illuminate\Http\Request;

class categoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public $category;
    public $temp;

    public function __construct(categoryInterface $category,tempInterface $temp){

        $this->middleware(["auth:api","can:category"])->except(["index","show"]);

        $this->temp=$temp;
        $this->category=$category;

    }
    public function index()
    {

        return response()->json($this->category->getallcategory());

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
        $status=$request->status;
        $rank=$request->rank;
        $description=$request->description;
        $meta_description=$request->meta_description;
        $meta_title=$request->meta_title;
        $url=$request->id_url;
        $meta_logo=$request->id_meta_logo;
        $parent_id=$request->parent_id;

        $url=$this->temp->remove($url)->getRawOriginal("url");
        $meta_logo=$this->temp->remove($meta_logo)->getRawOriginal("url");
        MoveFile($url,"temp","category");
        MoveFile($meta_logo,"temp","category");
        $category=$this->category->store($name,$status,$rank,$description,$meta_description,$meta_title,$url,$meta_logo,$parent_id);

        return response()->json($category);



    }

    /**
     * Display the specified resource.
     */
    public function show(category $category)
    {


        return response()->json($category);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(update $request, category $category)
    {


        $name=$request->name;
        $status=$request->status;
        $rank=$request->rank;
        $description=$request->description;
        $meta_description=$request->meta_description;
        $meta_title=$request->meta_title;
        $url=$request->id_url;
        $meta_logo=$request->id_meta_logo;
        $url=updateimage($url,$this->temp,"category",$category,"url");
        $meta_logo=updateimage($meta_logo,$this->temp,"category",$category,"meta_logo");
        $category=$this->category->update($category,$name,$status,$rank,$description,$meta_description,$meta_title,$url,$meta_logo);
        return response()->json($category);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(category $category)
    {
        $this->category->deletecategory($category);
        return response()->json();

    }
}