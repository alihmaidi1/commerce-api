<?php

namespace App\Http\Controllers;

use App\Http\Requests\user\changepassword;
use App\Http\Requests\user\getresetmessage;
use App\Http\Requests\user\login;
use App\Http\Requests\user\refreshtoken;
use App\Http\Requests\user\register;
use App\Http\Requests\user\verifyAccount;
use App\Http\Requests\user\verifyresetcode;
use App\Jobs\sendmail;
use App\Jobs\sendVerifyMail;
use App\Services\repo\interfaces\userInterface;

class userController extends Controller
{


    public $user;
    public function __construct(userInterface $user){


        $this->user=$user;

    }

    public function register(register $request){


        $name=$request->name;
        $email=$request->email;
        $password=$request->password;
        $code=time().rand(100000,999999);
        $user=$this->user->createUser($name,$email,$password,false,$code);
        $user->token=tokenInfo($email,$password,"users");
        dispatch(new sendVerifyMail($email,$code));
        return response()->json($user);





    }


    public function verifyAccount(verifyAccount $request){



        $this->user->verify();

        return response()->json(["message"=>"your account was verified successfully"]);




    }



    public function login(login $request){


            $email=$request->email;
            $password=$request->password;
            $token=tokenInfo($email,$password,"users");
            $user=$this->user->getUserByEmail($email);
            $user->tokens=$token;
            return response()->json($user,200);





    }



    public function refreshtoken(refreshtoken $request){






        return response()->json(refreshtoken($request->refreshtoken,"users"),200);



    }


    public function logout(){



        $user=auth("user")->user();
        $user->token()->revoke();
        return response()->json();



    }



    public function getresetmessage(getresetmessage $request){

        $code =time().rand(100000,999999);
        $email=$request->email;
        $this->user->updateCode($code,$email);
        $user=$this->user->getUserByEmail($email);

        dispatch(new sendmail($email,$code));
        $token=auth("reset_user")->login($user);
        return response()->json(["token"=>$token],200);


    }




    public function verifyresetcode(verifyresetcode $request){


        $this->user->clearCode();

        $user=auth("reset_user")->user();
        $token=$user->createToken("reset")->accessToken;
        auth("reset_user")->logout();
        return response()->json(["token"=>$token]);




    }


    public function changepassword(changepassword $request){


        $password=$request->password;
        $user=auth("user")->user();
        auth("user")->user()->token()->revoke();
        $this->user->changePassword($user->id,$password);
        $user->tokens=tokenInfo($user->email,$password,"users");
        return response()->json($user);



    }
}