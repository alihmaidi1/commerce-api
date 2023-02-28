<?php

use Illuminate\Support\Facades\Route;
use Twilio\Rest\Client;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
// */

Route::get('/', function () {



//     $client = new Client(env("TWILIO_SID"), env("TWILIO_SECRET"));
//     $client->messages->create("+4368181744368", [
//         'from' => env("TWILIO_FROM"),
//         'body' => "hello user you can reset password by this code :".$this->code]);


    return view('welcome');
});
