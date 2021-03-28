<?php 
class Executer{
    public static function execute($rule,$user,$callback){
        if($rule || $user->hasRole("admin")){
            $callback();
        }
    }
}

?>