<?php

namespace App\Http\Controllers;

use App\Http\Resources\LocationResource;
use App\Http\Resources\TaskResource;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Task;

class TaskLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,Task $task)
    {
        //
        return TaskResource::collection(Task::search($request)->paginate($request->per_page??10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Task $task)
    {
        $validator = Validator::make($request->all(),Location::$createRules);
        if($validator->fails()){
            return response()->json([
                'errors'=>$validator->errors()
            ],402);
        }
        $location = Location::create($validator->validated());
        $task->locations()->save($location);
        return new LocationResource($location);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task, Location $location)
    {
        //
        return new LocationResource($location);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task, Location $location)
    {
        //
        if($this->user->hasRole("admin") || $this->user->owns($location)){
            $validator = Validator::make($request->all(),Location::$updateRules);
            $location->update($validator->validated());
            return new LocationResource($location);
        }
        return response()->json([
            'errors'=>[],
            'message'=> 'forbidden'
        ],403);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task, Location $location)
    {
        //
        if($this->user->hasRole("admin") || $this->user->owns($location)){
            $location->delete();
            return new LocationResource($location);
        }
        return response()->json([
            'errors'=>[],
            'message'=> 'forbidden'
        ],403);
    }
}
