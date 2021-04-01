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
}
