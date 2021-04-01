<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends BaseModel
{
    use HasFactory;
    protected $guarded = [];
    public function chat(){
        return $this->belongsTo(Chat::class);
    }
    public static $createRules= [
        'text'=>'string',
        'media_id'=>'nullable'
    ];
    public static $updateRules= [];
    public function gallery(){
        return $this->belongsTo(Gallery::class);
    }
}
