<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRequest extends Model
{
    public static $types = [
        'callback' => 'Перезвонить',
        'order' => 'Новый заказ',
        'cooperation' => 'Сотрудничество',
        'question' => 'Вопрос',
        'offer' => 'Предложение',
        'other' => 'Другое',
    ];
    protected $fillable = [
        'client_id',
        'type',
        'data',
    ];

    public function getDataAttribute($value)
    {
        return json_decode($value, true);
    }

    public function setDataAttribute($value)
    {
        $this->attributes['data'] = json_encode($value);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
