<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin;
use App\Http\Controllers\bannerController;
use App\Http\Controllers\brandController;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\cityController;
use App\Http\Controllers\countryController;
use App\Http\Controllers\currencyController;
use App\Http\Controllers\imageController;
use App\Http\Controllers\productController;
use App\Http\Controllers\propertyController;
use App\Http\Controllers\sliderController;
use App\Services\repo\classes\country;

Route::group(["prefix"=>"admin"],function(){



    Route::post("/login",[admin::class,"login"])->middleware("throttle:login");
    Route::post("/getresetmessage",[admin::class,"getresetmessage"])->middleware("throttle:reset");
    Route::post("/verifiedcode",[admin::class,"verifiedcode"])->middleware(["throttle:reset","auth:reset_admin"]);



    Route::apiResource("currency",currencyController::class);
    Route::apiResource("slider",sliderController::class);
    Route::apiResource("banner",bannerController::class);
    Route::apiResource("category",categoryController::class);
    Route::apiResource("brand",brandController::class);
    Route::apiResource("country",countryController::class);
    Route::apiResource("city",cityController::class);
    Route::apiResource("property",propertyController::class);
    Route::apiResource("product",productController::class);




    Route::group(["middleware"=>"auth:api"],function(){

        // password authentication
        Route::post("/refreshtoken",[admin::class,"refreshtoken"]);
        Route::post("/logout",[admin::class,"logout"]);
        Route::post("/changepassword",[admin::class,"changepassword"])->middleware(["throttle:reset"]);








    });

});

Route::post('uploadimage',[imageController::class,"uploadimage"]);
Route::post('uploadimages',[imageController::class,"uploadimages"]);