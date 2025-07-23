<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'service_id',
        'timing',
        'chat_history',
        'status'
    ];

    protected $casts = [
        'chat_history' => 'array'
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
