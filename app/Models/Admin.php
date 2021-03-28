<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends User
{
    protected $guarded = [];
    use HasFactory;
    public static $createRules= [];
    public static $updateRules= [];

}
