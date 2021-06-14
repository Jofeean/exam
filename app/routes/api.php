<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\UserController;
use \App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::resource("/user", UserController::class);
Route::post("/login", [UserController::class, "login"])->middleware('throttle:5:5')->name("login"); //throttle:attempts:minutes

Route::middleware('auth:api')->group(function () {
    Route::post('/order', [ProductController::class, 'order']);
//    Route::get('/mail', function () {
//        dispatch(new \App\Jobs\SendMail("jofeean@gmail.com"));
////        \Illuminate\Support\Facades\Mail::to("jofeean@gmail.com")->send(new \App\Mail\UserVerification());
//        return "done";
//    });
});

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
