<?php

namespace App\Http\Controllers;

use App\HelperClasses\RequestIdentifier;
use App\HelperClasses\RequestValidator;
use App\HelperClasses\ResponseManager;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public $user;
    public static $except=[];
    public $resource;
    public function __construct(Request $request)
    {
        $this->user = RequestIdentifier::getUser($request);
        $class =get_class($this);
        $class=substr(strrchr($class, "\\"), 1);
        $model_name =substr($class,0,strpos($class,"Controller"));
        $this->model = 'App\\Models\\'.$model_name;
        $this->resource = 'App\\Http\\Resources\\'.$model_name.'Resource';
    }
    public function dynamicStore(Request $request,$model,$parent_model=null){
        $validator = RequestValidator::validator($request,$model::$createRules,$model::$createErrorMessages);
        if($validator->fails()){
            return ResponseManager::respondWithErrors($validator->errors());
        }
        $instance = $model::create($validator->validated());
        if($parent_model){
            $child_relation = $model.'s';
            $parent_model->$child_relation()->save($instance);
        }
        $resource = str_replace("App\\Models","App\\Http\\Resources",$model).'Resource';
        return new $resource($instance);
    }
    public function dynamicUpdate(Request $request,$instance,$model){
        $validator = RequestValidator::validator($request,$model::$createRules,$model::$createErrorMessages);
        $instance->update($validator->validated());
        $resource = str_replace("App\\Models","App\\Http\\Resources",$model).'Resource';
        return new $resource($instance);
    }
    public function dynamicDelete($instance){
        if($instance->delete()){
            return ResponseManager::respondWithSuccess();
        }
        return ResponseManager::respondWithNotPermitted();
    }
    public function notPermitted(){
        return ResponseManager::respondWithNotPermitted();
    }
    public function success(){
        return ResponseManager::respondWithSuccess();
    }
    public function errors($errors){
        return ResponseManager::respondWithErrors($errors);
    }
}
