<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use Laratrust\Traits\LaratrustUserTrait;

class Gardner extends User
{
    use LaratrustUserTrait;
    
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['list_identifiers', 'full_name', 'headers'];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
    public function chats()
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
    public function getListIdentifiersAttribute()
    {
        return ['gardner.full_name', 'writer.full_name'];
    }
    public function getFullNameAttribute()
    {
        return "$this->first_name $this->middle_name $this->last_name";
    }
    public function getHeadersAttribute()
    {
        return [
            'id',
            'full_name',
            'email',
            'mobile'
        ];
    }
}
