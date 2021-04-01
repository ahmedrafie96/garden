<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laratrust\Traits\LaratrustUserTrait;

class Admin extends User
{
    use LaratrustUserTrait;
    protected $appends = ['list_identifiers','full_name'];

    protected $guarded = [];
    use HasFactory;
    public static $createRules= [];
    public static $updateRules= [];

    public function getListIdentifiersAttribute()
    {
        return ['admin.full_name','writer.full_name'];
    }
    public function getFullNameAttribute()
    {
        return "$this->first_name $this->middle_name $this->last_name";
    }

}
