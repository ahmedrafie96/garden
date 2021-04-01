<?php

namespace App\Http\Controllers;

use App\Http\Resources\ChatResource;
use App\Http\Resources\GardnerResource;
use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Gardner;

class GardnerChatController extends Controller
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
        return GardnerResource::collection($gardner->chats()->search($request)->paginate($request->per_page??10));
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
        $validator = Validator::make($request->all(),Chat::$createRules);
        if($validator->fails()){
            return response()->json([
                'errors'=>$validator->errors()
            ],402);
        }
        $chat = Chat::create($validator->validated());
        $gardner->chats()->save($chat);
        return new ChatResource($chat);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gardner  $gardner
     * @param  \App\Models\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function show(Gardner $gardner, Chat $chat)
    {
        //
        return new ChatResource($chat);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gardner  $gardner
     * @param  \App\Models\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gardner $gardner, Chat $chat)
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
     * @param  \App\Models\Gardner  $gardner
     * @param  \App\Models\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gardner $gardner, Chat $chat)
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
