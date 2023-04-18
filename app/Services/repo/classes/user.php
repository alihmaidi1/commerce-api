<?php

namespace App\Services\repo\classes;

use App\Models\User as ModelsUser;
use App\Services\repo\interfaces\userInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class user implements userInterface{

    public function createUser($name,$email,$password,$status,$code=null){

        return ModelsUser::create([

            "name"=>$name,
            "email"=>$email,
            "password"=>Hash::make($password),
            "status"=>$status,
            "code"=>$code

        ]);

    }

    public function verify(){


        ModelsUser::where("id",auth("user")->user()->id)->update([

            "code"=>null,
            "status"=>true

        ]);

    }

    public function getUserByEmail($email){


        return ModelsUser::where("provider_id",null)->where("email",$email)->first();


    }


    public function updateCode($code,$email){

        return ModelsUser::where("provider_id",null)->where("email",$email)->update([

            "code"=>$code
        ]);
    }
    public function clearCode(){

        return ModelsUser::where("id",auth("reset_user")->user()->id)->update([

            "code"=>null

        ]);
    }

    public function changePassword($id,$password){

        return ModelsUser::where("id",$id)->update([

            "password"=>Hash::make($password)
        ]);

    }


}
