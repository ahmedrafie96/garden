<?php

namespace App\Http\Controllers;

use App\Http\Resources\GardnerResource;
use App\Models\Gardner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class GardnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->middleware('authorizor:admin');
    }
    public function index(Request $request)
    {
        //
        return GardnerResource::collection(Gardner::search($request)->paginate($request->per_page??10));
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
        $validator = Validator::make($request->all(),Gardner::$createRules);
        if($validator->fails()){
            return response()->json([
                'errors'=>$validator->errors()
            ],402);
        }
        $gardner = Gardner::create($validator->validated());
        return new GardnerResource($gardner);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gardner  $gardner
     * @return \Illuminate\Http\Response
     */
    public function show(Gardner $gardner)
    {
        //
        return new GardnerResource($gardner);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gardner  $gardner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gardner $gardner)
    {
        //
        if($this->user->hasRole("admin") || $this->user->owns($gardner)){
            $validator = Validator::make($request->all(),Gardner::$updateRules);
            $gardner->update($validator->validated());
            return new GardnerResource($gardner);
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
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gardner $gardner)
    {
        //
        if($this->user->hasRole("admin") || $this->user->owns($gardner)){
            $gardner->delete();
            return new GardnerResource($gardner);
        }
        return response()->json([
            'errors'=>[],
            'message'=> 'forbidden'
        ],403);
    }
}
