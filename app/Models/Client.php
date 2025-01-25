<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ['name', 'phones', 'email', 'addresses', 'comment'];

    protected $casts = [
        'phones' => 'array',
        'addresses' => 'array',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class, 'client_id', 'id');
    }
}
