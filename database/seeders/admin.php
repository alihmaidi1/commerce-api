<?php

namespace Database\Seeders;

use App\Models\admin as ModelsAdmin;
use App\Models\role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class admin extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        $role=role::create([

            "name"=>"super Admin",
            "permissions"=>json_encode(config("permissions"))
        ]);


        ModelsAdmin::create([

            "name"=>"admin",
            "email"=>"alihmaidi095@gmail.com",
            "password"=>Hash::make("ali450892"),
            "role_id"=>$role->id,
            "phone"=>"00963949363991"
        ]);



    }
}