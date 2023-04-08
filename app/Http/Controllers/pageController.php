<?php

namespace App\Http\Controllers;

use App\Http\Requests\page\store;
use App\Http\Requests\page\update;
use App\Models\page;
use App\Services\repo\interfaces\pageInterface;
use Illuminate\Http\Request;

class pageController extends Controller
{

    public $page;
    public function __construct(pageInterface $page){

        $this->page=$page;

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json($this->page->getAllPage(),200);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(store $request)
    {
        $content=$request->content;
        $url=$request->url;
        $page=$this->page->store($content,$url);

        return response()->json($page,200);

    }

    /**
     * Display the specified resource.
     */
    public function show(page $page)
    {
        return response()->json($page,200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(update $request, page $page)
    {
        $content=$request->content;
        $url=$request->url;
        $page=$this->page->update($content,$url,$page);

        return response()->json($page,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(page $page)
    {

        $this->page->delete($page);
        return response()->json();
    }
}
