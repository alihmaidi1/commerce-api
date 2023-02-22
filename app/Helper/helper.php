<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

function tokenInfo($email,$password,$provider){


    $client= DB::table('oauth_clients')->where("provider",$provider)->first();
    $token=Http::asForm()->post(request()->root()."/oauth/token",[
            'grant_type' => 'password',
            'client_id' =>$client->id,
            'client_secret' => $client->secret ,
            'username' => $email ,
            'password' => $password
    ]);

    if($token->status()==200){

        return $token->json();
    }
    throw new Exception("the email or password is not correct");

}



function refreshtoken($refreshtoken,$provider){


    $client= DB::table('oauth_clients')->where("provider",$provider)->first();
    $token=Http::asForm()->post(request()->root()."/oauth/token",[
            'grant_type' => 'refresh_token',
            'client_id' =>$client->id,
            'client_secret' => $client->secret ,
            'refresh_token' => $refreshtoken
    ]);

    if($token->status()==200){

        return $token->json();
    }
    throw new Exception("the refresh token is not correct");

}
