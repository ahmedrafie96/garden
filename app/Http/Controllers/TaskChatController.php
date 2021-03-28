<?php

namespace App\Http\Controllers;

use App\Http\Resources\ChatResource;
use App\Http\Resources\TaskResource;
use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Task;

class TaskChatController extends Controller
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
        $validator = Validator::make($request->all(),Chat::$createRules);
        if($validator->fails()){
            return response()->json([
                'errors'=>$validator->errors()
            ],402);
        }
        $chat = Chat::create($validator->validated());
        $task->chats()->save($chat);
        return new ChatResource($chat);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @param  \App\Models\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task, Chat $chat)
    {
        //
        return new ChatResource($chat);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @param  \App\Models\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task, Chat $chat)
    {
        //
        if($this->user->hasRole("admin") || $this->user->owns($chat)){
            $validator = Validator::make($request->all(),Chat::$updateRules);
            $chat->update($validator->validated());
            return new ChatResource($chat);
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
     * @param  \App\Models\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task, Chat $chat)
    {
        //
        if($this->user->hasRole("admin") || $this->user->owns($chat)){
            $chat->delete();
            return new ChatResource($chat);
        }
        return response()->json([
            'errors'=>[],
            'message'=> 'forbidden'
        ],403);
    }
}
