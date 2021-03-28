<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Gardner extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function task()
    {
        return $this->hasMany(Task::class);
    }
    public function chat()
    {
        return $this->hasManyThrough(Chat::class, Task::class);
    }
    public static $createRules = [
        'first_name' => 'required',
        'middle_name' => 'nullable',
        'last_name' => 'nullable',
        'mobile' => 'nullable',
        'email' => 'nullable',
        'password' => 'required|min:6'
    ];
    public static $updateRules = [
        'first_name' => 'required',
        'middle_name' => 'nullable',
        'last_name' => 'nullable',
        'mobile' => 'nullable',
        'email' => 'nullable',
        'password' => 'sometimes|min:6'
    ];
    public function scopeSearch($query, Request $request)
    {
    }
}
