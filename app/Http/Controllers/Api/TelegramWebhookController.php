<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TelegramWebhookController extends Controller
{
    public function webhook(Request $request)
    {
        $data = $request->all();
        (new \App\Services\Telegram\TelegramMessageService())->sendMessage($data);
    }
}
