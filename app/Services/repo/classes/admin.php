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


}