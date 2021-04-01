<?php

namespace App\Http\Controllers;

use App\Http\Resources\GalleryResource;
use App\Models\Gallery;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class GalleryController extends Controller
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
        return GalleryResource::collection(Gallery::search($request)->paginate($request->per_page ?? 10));
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
        $validator = Validator::make($request->all(), Gallery::$createRules);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 402);
        }
        $gallery = Gallery::create(['name' => $validator->validated()['name']]);
        $path = $request->file('cover_image')->store(
            'media',
            'public'
        );

        $media = Media::create([
            'path' => $path,
            'gallery_id' => $gallery->id
        ]);
        $gallery->update(['image_id' => $media->id]);
        return new GalleryResource($gallery);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {
        //
        return new GalleryResource($gallery);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gallery $gallery)
    {
        //
        if ($this->user->hasRole("admin") || $this->user->owns($gallery)) {
            $validator = Validator::make($request->all(), Gallery::$updateRules);
            $gallery->update($validator->validated());
            return new GalleryResource($gallery);
        }
        return response()->json([
            'errors' => [],
            'message' => 'forbidden'
        ], 403);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery)
    {
        //
        if ($this->user->hasRole("admin") || $this->user->owns($gallery)) {
            $gallery->delete();
            return new GalleryResource($gallery);
        }
        return response()->json([
            'errors' => [],
            'message' => 'forbidden'
        ], 403);
    }
}
