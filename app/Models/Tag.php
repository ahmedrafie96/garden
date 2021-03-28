<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['list_identifier'];
    public function getListIdentifierAttribute()
    {
        return 'tag.name';
    }
}
