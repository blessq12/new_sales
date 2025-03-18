<?php

namespace App\Services;

class Telegram
{
    protected $token;
    protected $chatId;

    public function __construct()
    {
        $this->token = env('TELEGRAM_BOT_TOKEN');
        $this->chatId = env('TELEGRAM_CHAT_ID_GROUP');
    }

    public function sendMessage($message, $type = 'info')
    {
        if (is_array($message)) {
            $formattedMessage = $this->formatMessage(implode("\n", $message), $type);
        } else {
            $formattedMessage = $this->formatMessage($message, $type);
        }
        $url = "https://api.telegram.org/bot{$this->token}/sendMessage";
        $data = [
            'chat_id' => $this->chatId,
            'text' => $formattedMessage,
        ];
        $options = [
            'http' => [
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data),
            ],
        ];
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);

        if ($result === false) {
            return false;
        }
        $response = json_decode($result, true);
        return isset($response['ok']) && $response['ok'] === true;
    }

    protected function formatMessage($message, $type)
    {
        switch ($type) {
            case 'info':
                return "ℹ️ Информация: \n\n" . $message;
            case 'alert':
                return "⚠️ Внимание: \n\n" . $message;
            case 'success':
                return "✅ Успех: \n\n" . $message;
            case 'callback':
                return "🔄 Обратная связь: \n\n" . $message;
            case 'order':
                return "📦 Заказ: \n\n" . $message;
            case 'offer':
                return "💼 Предложение: \n\n" . $message;
            case 'cooperation':
                return "🤝 Сотрудничество: \n\n" . $message;
            case 'question':
                return "❓ Вопрос: \n\n" . $message;
            case 'other':
                return "🔍 Другое: \n\n" . $message;
            default:
                return $message;
        }
    }
}
