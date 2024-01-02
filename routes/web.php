<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});


//Permet de capturer tous les url et de retourner la vue welcome
//où les routes seront prisent en charge par vue-router

Route::get('/{pathMatch}', function () {

    return view('welcome');

})->where('pathMatch','.*');

