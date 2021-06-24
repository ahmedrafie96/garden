<?php

namespace App\Http\Controllers;

use App\Http\Resources\ItemResource;
use App\Http\Resources\TagResource;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Item;

class ItemTagController extends Controller
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
        $validator = Validator::make($request->all(), [
            'tags.*'=>'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 402);
        }
        $tags = $validator->validated();
        // return response()->json($tags);
        foreach ($tags['tags'] as $tag_id) {
            $item->tags()->save(Tag::find($tag_id));
        }
        return response()->json(['message'=>'done']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item, Tag $tag)
    {
        //
        return new TagResource($tag);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item, Tag $tag)
    {
        //
        if ($this->user->hasRole("admin") || $this->user->owns($tag)) {
            $validator = Validator::make($request->all(), Tag::$updateRules);
            $tag->update($validator->validated());
            return new TagResource($tag);
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
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item, Tag $tag)
    {
        //
        if ($this->user->hasRole("admin") || $this->user->owns($tag)) {
            $tag->delete();
            return new TagResource($tag);
        }
        return response()->json([
            'errors' => [],
            'message' => 'forbidden'
        ], 403);
    }
}
