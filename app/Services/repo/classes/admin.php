<?php

namespace App\Services\repo\classes;

use App\Models\admin as ModelsAdmin;
use App\Services\repo\interfaces\adminInterface;
use Illuminate\Support\Facades\Cache;

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



}