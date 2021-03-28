<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
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
