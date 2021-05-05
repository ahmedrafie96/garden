<?php

namespace App\Http\Controllers;

use App\Http\Resources\TypeResource;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TypeController extends Controller
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
        //
        return TypeResource::collection(Type::search($request)->paginate($request->per_page ?? 10));
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
        $validator = Validator::make($request->all(), Type::$createRules);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 402);
        }
        $type = Type::create($validator->validated());
        if ($request->translations) {
            foreach ($request->translations as $translation)
                $type->setTranslation($translation['field'], $translation['locale'], $translation['value'])->save();
        }
        return new TypeResource($type);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Type $type)
    {
        //
        $validator = Validator::make($request->all(), Type::$updateRules);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 402);
        }
        $type->update($validator->validated());
        if ($request->translations) {
            foreach ($request->translations as $translation)
                $type->setTranslation($translation['field'], $translation['locale'], $translation['value'])->save();
        }
        // $validator = Validator::make($request->all(), Type::$createRules);
        // if ($validator->fails()) {
        //     return response()->json(['errors' => $validator->errors()]);
        // }
        // $type = Type::create($validator->validated());
        return new TypeResource($type);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type)
    {
        $type->delete();
        return new TypeResource($type);
    }
}
