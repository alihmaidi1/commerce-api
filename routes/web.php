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
*/

Route::get('/', function () {

    $client = new Client(env("TWILIO_SID"), env("TWILIO_SECRET"));
    $client->messages->create("+963949363991", [
        'from' => env("TWILIO_FROM"),
        'body' => "hello from test mode"]);

    return view('welcome');
});
