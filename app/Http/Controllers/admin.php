<?php

namespace App\Http\Controllers;

use App\Http\Requests\admin\login;
use App\Http\Requests\admin\refreshtoken;
use App\Http\Requests\password\resetmessage;
use App\Services\repo\interfaces\adminInterface;
use App\Services\resetfactory\resetFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class admin extends Controller
{

    public $admin;
    public function __construct(adminInterface $admin){

        $this->admin=$admin;

    }

    public function login(login $request){


            $email=$request->email;
            $password=$request->password;
            $token=tokenInfo($email,$password,"admins");
            $admin=$this->admin->getAdminByEmail($email);
            $admin->tokens=$token;
            return response()->json($admin,200);



    }



    public function refreshtoken(refreshtoken $request){

            return response()->json(refreshtoken($request->refreshtoken,"admins"),200);

    }


    public function logout(Request $request){

            $user=auth("api")->user();
            $user->token()->revoke();
            return response()->json();

    }


    public function getresetmessage(resetmessage $request){


        // $reset=new resetFactory();
        // $resetMothod=$reset->getReset($request->type);
        // $resetMothod->send($request->source,);













    }



}