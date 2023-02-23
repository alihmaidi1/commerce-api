<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Image;
use File;

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


function storeResize($image,$name){


    $image=Image::make($image);
    $v1=$image->resize(200,300)->save(public_path("temp/v1/".$name),50);
    $v2=$image->resize(500,700)->save(public_path("temp/v2/".$name),70);
    $v3=$image->resize(1000,1200)->save(public_path("temp/v3/".$name),90);


}


function storeResizeImages($images,$temp){

    $arr=[];
    foreach($images as $image){

        $name=time().rand(100000,999999).".".$image->extension();
        $image=Image::make($image);
        $v1=$image->resize(200,300)->save(public_path("temp/v1/".$name),50);
        $v2=$image->resize(500,700)->save(public_path("temp/v2/".$name),70);
        $v3=$image->resize(1000,1200)->save(public_path("temp/v3/".$name),90);
        $arr[]=$temp->store($name);

    }

    return $arr;


}