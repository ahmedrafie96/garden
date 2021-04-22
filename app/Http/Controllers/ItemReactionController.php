<?php

namespace App\Http\Controllers;

use App\Http\Resources\ItemResource;
use App\Http\Resources\ReactionResource;
use App\Models\Reaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Item;
use App\Models\Post;

class ItemReactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Item $item)
    {
        //
        return ItemResource::collection(Item::search($request)->paginate($request->per_page ?? 10));
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
        $validator = Validator::make($request->all(), Reaction::$createRules);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 402);
        }
        $arr = $validator->validated();
        if (isset($arr['item_id']) || isset($arr['post_id'])) {
            $item_class = Item::class;
            $post_class = Post::class;
            $type = isset($arr['item_id']) ? $item_class : (isset($arr['post_id']) ? $post_class : null);
            if ($type)
                $arr = [
                    'reactable_id' => $arr[($type == Item::class ? 'item' : 'post') . '_id'],
                    'reactable_type' => $type
                ];
        }
        if (sizeof($arr) > 0) {
            $reaction = Reaction::create($validator->validated());
            $item->reactions()->save($reaction);
            $reaction->user()->associate($this->user)->save();
            return new ReactionResource($reaction);
        }
        return response()->json(['message' => 'you must specify entity'], 422);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @param  \App\Models\Reaction  $reaction
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item, Reaction $reaction)
    {
        //
        return new ReactionResource($reaction);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @param  \App\Models\Reaction  $reaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item, Reaction $reaction)
    {
        //
        if ($this->user->hasRole("admin") || $this->user->owns($reaction)) {
            $validator = Validator::make($request->all(), Reaction::$updateRules);
            $reaction->update($validator->validated());
            return new ReactionResource($reaction);
        }
        return response()->json([
            'errors' => [],
            'message' => 'forbidden'
        ], 403);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @param  \App\Models\Reaction  $reaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item, Reaction $reaction)
    {
        //
        if ($this->user->hasRole("admin") || $this->user->owns($reaction)) {
            $reaction->delete();
            return new ReactionResource($reaction);
        }
        return response()->json([
            'errors' => [],
            'message' => 'forbidden'
        ], 403);
    }
}
