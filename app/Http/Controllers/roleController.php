<?php

namespace App\Http\Controllers;

use App\Http\Requests\role\deleteRequest;
use App\Http\Requests\role\storeRequest;
use App\Http\Requests\role\updateRequest;
use App\Models\role;
use App\Services\repo\interfaces\roleInterface;

class roleController extends Controller
{


    public $role;
    public function __construct(roleInterface $role){

        $this->role=$role;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json($this->role->getAllRole());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(storeRequest $request)
    {

        $name=$request->name;
        $permissions=$request->permissions;
        $role=$this->role->store($name,$permissions);

        return response()->json($role);

    }

    /**
     * Display the specified resource.
     */
    public function show(role $role)
    {
        return response()->json($role);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(updateRequest $request, role $role)
    {

        $name=$request->name;
        $permissions=$request->permissions;
        $role=$this->role->update($role,$name,$permissions);
        return response()->json($role);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(deleteRequest $request,role $role)
    {


        $this->role->deleteRole($role);


        return response()->json();
    }
}