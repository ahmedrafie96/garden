<?php
namespace App\HelperClasses;
use Illuminate\Http\Request;

class RequestIdentifier{
    public static function getUser(Request $request){
        return $request->user($request->get("guard"));
    }
}
?>