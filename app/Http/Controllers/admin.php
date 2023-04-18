<?php

namespace App\Http\Controllers;

use App\Http\Requests\admin\changepassword;
use App\Http\Requests\admin\login;
use App\Http\Requests\admin\refreshtoken;
use App\Http\Requests\admin\reset;
use App\Http\Requests\password\resetmessage;
use App\Services\repo\interfaces\adminInterface;
use App\Services\resetfactory\resetFactory;
use Illuminate\Http\Request;

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

        $code =time().rand(100000,999999);
        $reset=new resetFactory();
        $resetMothod=$reset->getReset($request->type,$this->admin);
        $admin=$resetMothod->send($request->source,$code);
        $token=auth("reset_admin")->login($admin);
        return response()->json(["token"=>$token],200);


    }


    public function verifiedcode(reset $request){

        $code=$request->code;
        $admin=$this->admin->ClearCode($code);
        $token=$admin->createToken("reset")->accessToken;
        auth("reset_admin")->logout();
        return response()->json(["token"=>$token]);


    }


    public function changepassword(changepassword $request){


        $password=$request->password;
        $id=auth("api")->user()->id;
        auth("api")->user()->token()->revoke();
        $admin=$this->admin->changePassword($id,$password);
        $admin->tokens=tokenInfo($admin->email,$password,"admins");
        return response()->json(["message"=>"the password was changed successfully"]);


    }


}
