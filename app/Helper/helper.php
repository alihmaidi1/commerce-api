<?php

use App\Models\currency;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

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

        // $image=Image::make($image);
        // $v1=$image->resize(200,300);
        // $v2=$image->resize(500,700);
        // $v3=$image->resize(1000,1200);
        // Storage::disk("s3")->putFileAs("temp/v1",$v1,$name);



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


 function MoveFile($imageUrl,$from,$to,$id=null){

    if($id!=null){

        File::move(public_path($from."/v1/".$imageUrl), public_path($to."/v1/".$id."/".$imageUrl));
        File::move(public_path($from."/v2/".$imageUrl), public_path($to."/v2/".$id."/".$imageUrl));
        File::move(public_path($from."/v3/".$imageUrl), public_path($to."/v3/".$id."/".$imageUrl));

    }else{

        File::move(public_path($from."/v1/".$imageUrl), public_path($to."/v1/".$imageUrl));
        File::move(public_path($from."/v2/".$imageUrl), public_path($to."/v2/".$imageUrl));
        File::move(public_path($from."/v3/".$imageUrl), public_path($to."/v3/".$imageUrl));


    }

}


function MoveFiles($images,$from,$to,$id=null){



        foreach($images as $image){

            MoveFile($image->url,$from,$to,$id);


        }






}



function updateimage($image_id,$temp,$to,$object,$name,$id=null){


    if($image_id!=null){

        $url=$temp->getTemp($image_id)->getRawOriginal("url");
        $temp->remove($image_id);

        MoveFile($url,"temp",$to,$id);
        $id=($id!=null)?$id."/":"";
        unlink(public_path($to."/v1/".$id.$object->getRawOriginal($name)));
        unlink(public_path($to."/v2/".$id.$object->getRawOriginal($name)));
        unlink(public_path($to."/v3/".$id.$object->getRawOriginal($name)));
        return $url;

    }else{

        return $object->getRawOriginal("url");


    }


}

function deleteImage($url,$from){

    unlink(public_path($from."/v1/".$url));
    unlink(public_path($from."/v2/".$url));
    unlink(public_path($from."/v3/".$url));

}

function makeDirectory($folder,$id){


    $path1=public_path($folder."/v1/".$id);
    $path2=public_path($folder."/v2/".$id);
    $path3=public_path($folder."/v3/".$id);

    if(!File::isDirectory($path1)){
        File::makeDirectory($path1, 0777);

    }

    if(!File::isDirectory($path2)){
        File::makeDirectory($path2, 0777);

    }

    if(!File::isDirectory($path3)){
        File::makeDirectory($path3, 0777);

    }


}


function convertCurrency($productCurrency,$userCurrency,$price){


    $productCurrency=currency::find($productCurrency);
    $userCurrency=currency::find($productCurrency);
    $priceinDular=$price/$productCurrency->price;
    return $priceinDular*$userCurrency->value;



}