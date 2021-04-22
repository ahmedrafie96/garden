<?php

namespace App\Http\Controllers;

use App\Http\Resources\AccessorResource;
use App\Models\Accessor;
use Illuminate\Http\Request;

class AccessorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        return AccessorResource::collection(Accessor::search($request)->paginate($request->per_page ?? 10));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Accessor  $accessor
     * @return \Illuminate\Http\Response
     */
    public function show(Accessor $accessor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Accessor  $accessor
     * @return \Illuminate\Http\Response
     */
    public function edit(Accessor $accessor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Accessor  $accessor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Accessor $accessor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Accessor  $accessor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Accessor $accessor)
    {
        //
    }
}
