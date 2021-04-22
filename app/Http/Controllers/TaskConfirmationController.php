<?php

namespace App\Http\Controllers;

use App\Http\Resources\ConfirmationResource;
use App\Http\Resources\TaskResource;
use App\Models\Confirmation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Task;

class TaskConfirmationController extends Controller
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
        $validator = Validator::make($request->all(),Confirmation::$createRules);
        if($validator->fails()){
            return response()->json([
                'errors'=>$validator->errors()
            ],402);
        }
        $confirmation = Confirmation::create($validator->validated());
        $task->confirmations()->save($confirmation);
        return new ConfirmationResource($confirmation);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @param  \App\Models\Confirmation  $confirmation
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task, Confirmation $confirmation)
    {
        //
        return new ConfirmationResource($confirmation);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @param  \App\Models\Confirmation  $confirmation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task, Confirmation $confirmation)
    {
        //
        if($this->user->hasRole("admin") || $this->user->owns($confirmation)){
            $validator = Validator::make($request->all(),Confirmation::$updateRules);
            $confirmation->update($validator->validated());
            return new ConfirmationResource($confirmation);
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
     * @param  \App\Models\Confirmation  $confirmation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task, Confirmation $confirmation)
    {
        //
        if($this->user->hasRole("admin") || $this->user->owns($confirmation)){
            $confirmation->delete();
            return new ConfirmationResource($confirmation);
        }
        return response()->json([
            'errors'=>[],
            'message'=> 'forbidden'
        ],403);
    }
}
