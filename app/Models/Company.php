<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $casts = [
        'socials' => 'array',
        'phones' => 'array',
        'emails' => 'array',
        'addresses' => 'array',
        'serviceAreas' => 'array',
        'suburbs' => 'array',
    ];

    public function legals()
    {
        return $this->hasMany(CompanyLegal::class);
    }
}
