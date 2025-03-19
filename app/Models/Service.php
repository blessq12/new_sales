<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['name', 'slug', 'description', 'content', 'image', 'price', 'prefix'];

    public function orders()
    {
        return $this->hasMany(Order::class, 'service_id', 'id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'service_id', 'id');
    }
}
