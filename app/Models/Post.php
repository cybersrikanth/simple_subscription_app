<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'website_id',
        'title',
        'description'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function subscribers()
    {
        return $this->belongsToMany(Subscriber::class, SubscriberPost::class);
    }

    public function website()
    {
        return $this->belongsTo(Website::class);
    }
}
