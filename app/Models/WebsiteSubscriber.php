<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteSubscriber extends Model
{
    use HasFactory;

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function website()
    {
        return $this->belongsTo(Website::class);
    }

    public function subscriber()
    {
        return $this->belongsTo(Subscriber::class);
    }
}
