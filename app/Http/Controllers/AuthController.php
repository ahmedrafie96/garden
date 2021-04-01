<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\HelperClasses\ResponseManager;
use Illuminate\Support\Pluralizer;

// use Laravel\Socialite\Facades\Socialite;
class AuthController extends Controller
{
    //
    public $token;
    public $guardName;
    public function login(Request $request)
    {
        $cridentials = $request->only("email", "password");
        // ($cridentials);
        $this->token = null;
        $guards = ['customers', 'admins', 'gardners'];
        foreach ($guards as $guard){
            $token = $this->guard($guard)->attempt($cridentials);
            if($token){
                $this->guardName = $guard;
                break;
            }
        }

        $this->token = $token;
        if ($this->token != null) {
            return $this->respondWithToken($this->token);
        } else
            return response()->json(['error' => "authentication_error"], 401);
    }
    protected function respondWithToken($token)
    {
        return response()->json([
            'token' => [
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => $this->guard($this->guardName)->factory()->getTTL() * 60,
            ],
            'user' => Auth::guard($this->guardName)->user(),
            'type'=> Pluralizer::singular($this->guardName)
        ], 200);
    }
    public function guard($guard = 'customers')
    {
        return Auth::guard($guard);
    }
    public function logout(Request $request)
    {
        $this->guard()->logout();
        return ResponseManager::respondWithSuccess();
    }
    public function me(Request $request)
    {
        return ResponseManager::respondWithData($request->user());
    }
    public function refresh(Request $request)
    {

        return $this->respondWithToken($this->guard()->refresh());
    }
    // public function redirectToProvider(){
    //     return Socialite::driver('github')->redirect();
    // }
    // public function handleProviderCallback()
    // {
    //     $user = Socialite::driver('github')->user();
    //     // $user->token;
    // }

}
