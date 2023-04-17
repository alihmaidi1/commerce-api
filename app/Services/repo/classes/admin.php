<?php

namespace App\Services\repo\classes;

use App\Models\admin as ModelsAdmin;
use App\Services\repo\interfaces\adminInterface;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class admin implements adminInterface{

    public function getAdminByEmail($email){

        // return Cache::rememberForever("admin:".$email,function(){

            return ModelsAdmin::with(["role"])->first();

        // });
    }

    public function UpdateCodeByEmail($email,$code){

        $admin=ModelsAdmin::where("email",$email)->first();
        $admin->code=$code;
        $admin->save();
        return $admin;
    }
    public function UpdateCodeByPhone($phone,$code){

        $admin=ModelsAdmin::where("phone",$phone)->first();
        $admin->code=$code;
        $admin->save();
        return $admin;

    }

    public function ClearCode($code){

        $admin=ModelsAdmin::where("code",$code)->firstOrFail();
        $admin->code=null;
        $admin->save();
        return $admin;
    }


    public function changePassword($id,$password){

        $admin=ModelsAdmin::findOrFail($id);
        $admin->password=Hash::make($password);
        $admin->save();
        return $admin;



    }

    public function storeAdmin($name,$email,$password,$role_id,$phone){


        $admin=ModelsAdmin::create([

            "name"=>$name,
            "email"=>$email,
            "password"=>Hash::make($password),
            "role_id"=>$role_id,
            "phone"=>$phone
        ]);

        // Cache::pull("admins");
        $admin->role;
        return $admin;
    }

    public function updateAdmin($admin,$name,$email,$password,$role_id,$phone){

        $admin->name=$name;
        $admin->email=$email;
        $admin->password=$password;
        $admin->role_id=$role_id;
        $admin->phone=$phone;
        $admin->save();
        $admin->role;
        // Cache::pull("admins");
        return $admin;

    }


    public function getAllAdmin(){


        return ModelsAdmin::with("role")->where("id","!=",auth("api")->user()->id)->get();
    }

    public function deleteAdmin($admin){


        $admin->delete();
        // Cache::pull("admins");
        // Cache::pull("admin:".$admin->id);
    }


}
