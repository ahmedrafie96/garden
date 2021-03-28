<?php 
namespace App\HelperClasses;
class ResponseManager {

    public static function respondWithSuccess(){
        return response()->json(['status'=>'success'],200);
    }
    public static function respondWithData($data){
        return response()->json(['status'=>'success','data'=>$data],200);
    }
    public static function respondWithNotPermitted(){
        return response()->json(['status'=>'error','error'=>'User is not permitted to do this operation'],403);
    }
    public static function respondWithErrors($errors){
        return response()->json(['status'=>'error','error'=>$errors],402);
    }
    public static function respondWithForbidden(){
        return response()->json(['status'=>'error','error'=>"Forbidden"],403);
    }
    public static function respondWithBadRequest(){
        return response()->json(['status'=>'error','error'=>'bad request'],502);
    }
}
?>