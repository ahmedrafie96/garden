<?php

namespace App\Http\Controllers;

use App\Models\Rank;
use App\Http\Controllers\Controller;
use App\Http\Resources\ItemResource;
use App\Http\Resources\RankResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Item;

class ItemRankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,Item $item)
    {
        //
        return ItemResource::collection(Item::search($request)->paginate($request->per_page??10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Item $item)
    {
        $validator = Validator::make($request->all(),Rank::$createRules);
        if($validator->fails()){
            return response()->json([
                'errors'=>$validator->errors()
            ],402);
        }
        Rank::where('user_id','=',$this->user->id)->where('item_id','=',$item->id)->delete();
        $rank = Rank::create($validator->validated());
        $item->ranks()->save($rank);
        return new RankResource($rank);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @param  \App\Models\Rank  $rank
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item, Rank $rank)
    {
        //
        return new RankResource($rank);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @param  \App\Models\Rank  $rank
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item, Rank $rank)
    {
        //
        if($this->user->hasRole("admin") || $this->user->owns($rank)){
            $validator = Validator::make($request->all(),Rank::$createRules);
            $rank->update($validator->validated());
            return new RankResource($rank);
        }
        return response()->json([
            'errors'=>[],
            'message'=> 'forbidden'
        ],403);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @param  \App\Models\Rank  $rank
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item, Rank $rank)
    {
        //
        if($this->user->hasRole("admin") || $this->user->owns($rank)){
            $rank->delete();
            return new RankResource($rank);
        }
        return response()->json([
            'errors'=>[],
            'message'=> 'forbidden'
        ],403);
    }
}
