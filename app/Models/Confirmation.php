<?php

namespace App\Models;

use App\Mail\confirmationEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class Confirmation extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static $createRules = [
        'post_id' => 'sometimes|exists:posts,id',
        'gallery_id' => 'sometimes|exists:galleries,id',
        // 'name'=>'required',
        'country_id' => 'required|numeric',
        'city_id' => 'required|numeric',
        'lat' => 'nullable|numeric',
        'lng' => 'nullable|numeric',
        'tree_number' => 'required',
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
        return $this->hasOne(Post::class , 'id');
    }
    public function gallery()
    {
        return $this->hasOne(Gallery::class , 'id');
    }

     // i added this relation
    public function task(){
        return $this->belongsTo(Task::class);
    }
    public function sendEmail(){
        // $email , $tree_number , $post , $photo
        $customer = $this->task->customer;
        $tree_number = $this->tree_number;
        $post = $this->post;
        $photo = $this->gallery->url;
        Mail::to($customer->email)
        ->send(new confirmationEmail($customer, $tree_number , $post , $photo));
    }
}
