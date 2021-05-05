<?php

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// generate routes for every registered resource controller
$controllers = require base_path('vendor/composer/autoload_classmap.php');
$controllers = array_keys($controllers);
$controllers = array_filter($controllers, function ($controller) {
    return strpos($controller, 'App\Http\Controllers') !== false && strlen($controller) > 31 && strpos($controller,'Auth')== false && strpos($controller, 'User') == false;
});
array_map(function ($controller) {
    $controllerName = str_replace('App\Http\Controllers\\', '', $controller);
    $models = substr($controllerName, 0, -10);
    $models = preg_split('/(?=[A-Z])/', $models, -1, PREG_SPLIT_NO_EMPTY);
    $models = array_map(function ($model) {
        return lcfirst($model);
    }, $models);
    $params = join(".", $models);
    Route::apiResource($params,$controllerName)->shallow();
}, $controllers);
Route::group(['prefix' => 'auth', 'middleware' => 'api', 'as' => 'auth.'], function () {
    $auth_routes = ['login', 'me', 'logout', 'refresh'];
    foreach ($auth_routes as $auth_route) {
        Route::post("/" . $auth_route, "AuthController@" . $auth_route)->name($auth_route);
    }
    Route::post("/{provider}/callback","AuthController@SocialSignup");
});
// Route::group(['prefix' => 'user', 'middleware' => 'api', 'as' => 'user.'], function () {
//     $users_routes = ['register', 'changePassword', 'resetPassword', 'block'];
//     foreach ($users_routes as $users_route) {
//         Route::post("/" . $users_route, "UserController@" . $users_route)->name($users_route);
//     }
// });
// Route::get("/list-routes",function(){
//     return User::find(1);
// });
// Route::post('sociallogin/{provider}', 'AuthController@SocialSignup');
