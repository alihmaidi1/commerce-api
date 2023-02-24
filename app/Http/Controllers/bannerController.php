<?php

namespace App\Http\Controllers;

use App\Http\Requests\banner\store;
use App\Http\Requests\banner\update;
use App\Models\banner;
use App\Services\repo\interfaces\bannerInterface;
use App\Services\repo\interfaces\tempInterface;
use Illuminate\Http\Request;

class bannerController extends Controller
{


    public $temp;
    public $banner;
    public function __construct(tempInterface $temp,bannerInterface $banner){

        $this->middleware(["auth:api","can:currency"])->except(["index","show"]);

        $this->temp=$temp;
        $this->banner=$banner;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        return response()->json($this->banner->getallbanner());

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


        $image_id=$request->image_id;
        $status=$request->status;
        $rank=$request->rank;
        $link=$request->link;
        $show=$request->show;
        $url=$this->temp->remove($image_id)->getRawOriginal("url");
        MoveFile($url,"temp","banner");
        $slider=$this->banner->store($url,$status,$rank,$link,$show);
        return response()->json($slider);



    }

    /**
     * Display the specified resource.
     */
    public function show(banner $banner)
    {


        return response()->json($banner);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(banner $banner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(update $request, banner $banner)
    {

        $image=$request->image_id;
        $rank=$request->rank;
        $status=$request->status;
        $link=$request->link;
        $show=$request->show;
        $url=updateimage($image,$this->temp,"banner",$banner,"url");
        $banner=$this->banner->update($banner,$url,$status,$rank,$link,$show);
        return response()->json($banner);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(banner $banner)
    {

        $this->banner->deleteBanner($banner);
        return response()->json();



    }
}
