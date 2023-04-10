<?php

namespace App\Http\Controllers;

use App\Http\Requests\admin\storeRequest;
use App\Http\Requests\admin\UpdateRequest;
use App\Models\admin;
use App\Services\repo\interfaces\adminInterface;

class adminController extends Controller
{

    public $admin;
    public function __construct(adminInterface $admin){

        $this->middleware("auth:api");
        $this->admin=$admin;

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        return response()->json($this->admin->getAllAdmin());

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(storeRequest $request)
    {

        $name=$request->name;
        $email=$request->email;
        $password=$request->password;
        $role_id=$request->role_id;
        $phone=$request->phone;

        $admin=$this->admin->storeAdmin($name,$email,$password,$role_id,$phone);

        return response()->json($admin);


    }

    /**
     * Display the specified resource.
     */
    public function show(admin $admin)
    {

        return response()->json($admin);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, admin $admin)
    {
        $name=$request->name;
        $email=$request->email;
        $password=$request->password;
        $role_id=$request->role_id;
        $phone=$request->phone;
        $admin=$this->admin->updateAdmin($admin,$name,$email,$password,$role_id,$phone);
        return response()->json($admin);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(admin $admin)
    {
        $this->admin->deleteAdmin($admin);

        return response()->json();
    }
}
