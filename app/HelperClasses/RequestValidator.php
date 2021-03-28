<?php
namespace App\HelperClasses;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RequestValidator{
    public static function validator(Request $request,$rules,$errorMessages){
        return Validator::make($request->all(),$rules,$errorMessages);
    }
    public static function respondWithErrors($errors){
        return ResponseManager::respondWithErrors($errors);
    }
}

?>