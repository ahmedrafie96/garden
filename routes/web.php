<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

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

Route::get('test', function () {
    return response()->json([env('TEST'), env('DB_USERNAME')]);
});
Route::get('setup', function () {
    $setup = file_get_contents('../setup');
    if (!$setup == '1') {
        // $env = "DB_HOST=$host\nDB_NAME=$db_name\nDB_USERNAME=$user\nDB_PASSWORD=$pass";
        // file_put_contents('../db.env',$env);
        // app()->loadEnvironmentFrom('../db.env');
        Artisan::call('optimize');
        Artisan::call('migrate:fresh', ['--seed' => true, '--force' => true]);
        file_put_contents('../setup', '1');
        return response()->json('done');
    }
    return response()->json('already done');
});
Route::get('/dashboard/{any?}', function () {
    return view('dashboard');
});
Route::get('/{any?}', function () {
    header('content-type:text/html');
    return view('home');
});
