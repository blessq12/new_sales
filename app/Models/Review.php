<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['name', 'service_id', 'rating', 'message', 'agree_to_process_personal_data'];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
