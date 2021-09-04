<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriberPost extends Model
{
    use HasFactory;


    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function subscriber()
    {
        return $this->belongsTo(Subscriber::class);
    }
}
