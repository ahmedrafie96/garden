<?php

namespace App\Http\Controllers;

use App\Http\Resources\AccessorResource;
use App\Http\Resources\ItemResource;
use App\Models\Accessor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Item;

class ItemAccessorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->middleware('authorizor:admin', ['except' => ['index', 'show']]);
    }
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
        $validator = Validator::make($request->all(),Accessor::$createRules);
        if($validator->fails()){
            return response()->json([
                'errors'=>$validator->errors()
            ],402);
        }
        $accessor = Accessor::create($validator->validated());
        $item->accessors()->save($accessor);
        return new AccessorResource($accessor);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @param  \App\Models\Accessor  $accessor
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item, Accessor $accessor)
    {
        //
        return new AccessorResource($accessor);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @param  \App\Models\Accessor  $accessor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item, Accessor $accessor)
    {
        //
        if($this->user->hasRole("admin") || $this->user->owns($accessor)){
            $validator = Validator::make($request->all(),Accessor::$updateRules);
            $accessor->update($validator->validated());
            return new AccessorResource($accessor);
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
     * @param  \App\Models\Accessor  $accessor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item, Accessor $accessor)
    {
        //
        if($this->user->hasRole("admin") || $this->user->owns($accessor)){
            $accessor->delete();
            return new AccessorResource($accessor);
        }
        return response()->json([
            'errors'=>[],
            'message'=> 'forbidden'
        ],403);
    }
}
