<?php


namespace App\Services\repo\classes;

use App\Models\role as ModelsRole;
use App\Services\repo\interfaces\roleInterface;
use Illuminate\Support\Facades\Cache;

class role implements roleInterface{


    public function store($name,$permissions){


        $role=ModelsRole::create([

            "name"=>$name,
            "permissions"=>json_encode($permissions)

        ]);

        Cache::pull("roles");
        Cache::put("role:".$role->id,$role);

        return $role;

    }

    public function update($role,$name,$permissions){


        $role->name=$name;
        $role->permissions=json_encode($permissions);
        $role->save();
        Cache::pull("roles");
        Cache::put("rule:".$role->id,$role);
        return $role;


    }

    public function getAllRole(){


        return Cache::rememberForever("roles",function(){


            return ModelsRole::all();

        });
    }

    public function deleteRole($role){


        Cache::pull("roles");
        Cache::pull("role:".$role->id);
        $role->delete();

    }

}