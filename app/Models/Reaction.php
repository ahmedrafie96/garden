<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laratrust\Contracts\Ownable;

class Reaction extends BaseModel implements Ownable
{
    use HasFactory;
    public function user()
    {
        return $this->morphTo();
    }
    public function reactable()
    {
        return $this->morphTo();
    }
    public function ownerKey($owner)
    {
        return $this->user->id;
    }
    public static $createRules = [
        'item_id' => 'sometimes|exists:items,id',
        'post_id'=>'sometimes|exists:posts,id'
    ];
    public static $updateRules = [
        'item_id' => 'sometimes|exists:items,id',
        'post_id'=>'sometimes|exists:posts,id'

    ];
}
