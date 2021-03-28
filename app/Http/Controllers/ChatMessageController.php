<?php

namespace App\Http\Controllers;

use App\Http\Resources\ChatResource;
use App\Http\Resources\MessageResource;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Chat;

class ChatMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,Chat $chat)
    {
        //
        return ChatResource::collection(Chat::search($request)->paginate($request->per_page??10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Chat $chat)
    {
        $validator = Validator::make($request->all(),Message::$createRules);
        if($validator->fails()){
            return response()->json([
                'errors'=>$validator->errors()
            ],402);
        }
        $message = Message::create($validator->validated());
        $chat->messages()->save($message);
        return new MessageResource($message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Chat  $chat
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Chat $chat, Message $message)
    {
        //
        return new MessageResource($message);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Chat  $chat
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chat $chat, Message $message)
    {
        //
        if($this->user->hasRole("admin") || $this->user->owns($message)){
            $validator = Validator::make($request->all(),Message::$updateRules);
            $message->update($validator->validated());
            return new MessageResource($message);
        }
        return response()->json([
            'errors'=>[],
            'message'=> 'forbidden'
        ],403);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Chat  $chat
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chat $chat, Message $message)
    {
        //
        if($this->user->hasRole("admin") || $this->user->owns($message)){
            $message->delete();
            return new MessageResource($message);
        }
        return response()->json([
            'errors'=>[],
            'message'=> 'forbidden'
        ],403);
    }
}
