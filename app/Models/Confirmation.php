<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Confirmation extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static $createRules = [
        'post_id' => 'sometimes|exists:posts,id',
        'gallery_id' => 'sometimes|exists:galleries,id',
        // 'name'=>'required',
        'lat' => 'required|numeric',
        'lng' => 'required|numeric',
        'tree_number' => 'required|numeric',
    ];
    public static $updateRules = [
        'post_id' => 'sometimes|exists:posts,id',
        'gallery_id' => 'sometimes|exists:galleries,id',
        // 'name'=>'required',
        'lat' => 'sometimes|numeric',
        'lng' => 'sometimes|numeric',
        'tree_number' => 'sometimes|numeric',
    ];
    public function post()
    {
        return $this->hasOne(Post::class);
    }
    public function gallery()
    {
        return $this->hasOne(Gallery::class);
    }
}
