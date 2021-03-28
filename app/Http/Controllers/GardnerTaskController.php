<?php

namespace App\Http\Controllers;

use App\Http\Resources\GardnerResource;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Gardner;

class GardnerTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Gardner  $gardner
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,Gardner $gardner)
    {
        //
        return GardnerResource::collection(Gardner::search($request)->paginate($request->per_page??10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gardner  $gardner
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Gardner $gardner)
    {
        $validator = Validator::make($request->all(),Task::$createRules);
        if($validator->fails()){
            return response()->json([
                'errors'=>$validator->errors()
            ],402);
        }
        $task = Task::create($validator->validated());
        $gardner->tasks()->save($task);
        return new TaskResource($task);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gardner  $gardner
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Gardner $gardner, Task $task)
    {
        //
        return new TaskResource($task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gardner  $gardner
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gardner $gardner, Task $task)
    {
        //
        if($this->user->hasRole("admin") || $this->user->owns($task)){
            $validator = Validator::make($request->all(),Task::$updateRules);
            $task->update($validator->validated());
            return new TaskResource($task);
        }
        return response()->json([
            'errors'=>[],
            'message'=> 'forbidden'
        ],403);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gardner  $gardner
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gardner $gardner, Task $task)
    {
        //
        if($this->user->hasRole("admin") || $this->user->owns($task)){
            $task->delete();
            return new TaskResource($task);
        }
        return response()->json([
            'errors'=>[],
            'message'=> 'forbidden'
        ],403);
    }
}
