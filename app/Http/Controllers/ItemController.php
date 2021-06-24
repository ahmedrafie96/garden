<?php

namespace App\Http\Controllers;

use App\Http\Resources\ItemResource;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->middleware('authorizor:admin', ['except' => ['index', 'show']]);
    }
    public function index(Request $request)
    {
        if($request->related_to){
            return ItemResource::collection(Item::find($request->related_to)->related_items);
        }
        return ItemResource::collection(Item::with('accessors')->search($request)->paginate($request->per_page ?? 12));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), Item::$createRules);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 402);
        }
        $item = Item::create($validator->validated());
        $categories = Validator::make($request->all(), [
            'categories.*' => 'required|exists:categories,id'
        ]);
        $item->categories()->sync($categories->validated()['categories']);
        if ($request->translations) {
            foreach ($request->translations as $translation)
                $item->setTranslation($translation['field'], $translation['locale'], $translation['value'])->save();
        }
        return new ItemResource($item);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,Item $item)
    {
        return new ItemResource($item);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        Item::destroy($item->id);
    }
}
