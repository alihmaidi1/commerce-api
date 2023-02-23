<?php

namespace App\Services\repo\classes;

use App\Models\admin as ModelsAdmin;
use App\Services\repo\interfaces\adminInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class admin implements adminInterface{

    public function getAdminByEmail($email){

        return Cache::rememberForever("admin:".$email,function(){

            return ModelsAdmin::with(["role"])->first();

        });
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



}