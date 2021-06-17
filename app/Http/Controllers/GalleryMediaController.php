<?php

namespace App\Http\Controllers;

use App\Http\Resources\GalleryResource;
use App\Http\Resources\MediaResource;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Gallery;

class GalleryMediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Gallery $gallery)
    {
        //
        return GalleryResource::collection($gallery->media()->search($request)->paginate($request->per_page ?? 10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Gallery $gallery)
    {
        $validator = Validator::make($request->all(), Media::$createRules);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 402);
        }
        $arr = $validator->validated();
        unset($arr['file']);
        $path = $request->file('file')->store(
            'media',
            'public'
        );
        $arr += ['path' => $path];
        $media = Media::create($arr);
        return new MediaResource($media);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @param  \App\Models\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery, Media $media)
    {
        //
        return new MediaResource($media);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gallery  $gallery
     * @param  \App\Models\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gallery $gallery, Media $media)
    {
        //
        if ($this->user->hasRole("admin") || $this->user->owns($media)) {
            $validator = Validator::make($request->all(), Media::$updateRules);
            $media->update($validator->validated());

            $path = $request->file('file')->store(
                'media',
                'public'
            );
            $arr = ['path' => $path];
            $media->update($arr);
            return new MediaResource($media);
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
     * @param  \App\Models\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery, Media $media)
    {
        //
        if ($this->user->hasRole("admin") || $this->user->owns($media)) {
            $media->delete();
            return new MediaResource($media);
        }
        return response()->json([
            'errors' => [],
            'message' => 'forbidden'
        ], 403);
    }
}
