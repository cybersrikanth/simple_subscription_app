<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Website extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'url', 
        'name'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function subscribers()
    {
        return $this->belongsToMany(subscriber::class, 'website_subscribers');
    }
}
