<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TelegramChat extends Model
{
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'username',
        'chat_type',
        'last_message',
        'last_message_id',
        'media',
        'entities'
    ];
}
