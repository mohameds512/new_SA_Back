<?php

use App\Models\System\SystemMail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\langController;


use App\Models\System\ASUENGMigrate;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
//    return view('home');
    return    env('DB_DATABASE');

});
