<?php

namespace App\Services\Telegram;

use Illuminate\Support\Facades\Log;

class TelegramMessageService extends TelegramService
{
    public $threads = [
        'event' => 1138,
        'analytics' => 1051,
        'error' => 1136,
        'order' => 1053,
    ];

    public function __construct()
    {
        parent::__construct();
    }

    public function sendMessage($message, ?string $thread = null)
    {
        try {
            $url = 'sendMessage';
            $options = [
                'json' => [
                    'chat_id' => $this->chatId,
                    'text' => $this->prepareMessage($message),
                    'parse_mode' => 'HTML'
                ]
            ];

            if ($thread && $this->getThread($thread)) {
                $options['json']['message_thread_id'] = $this->getThread($thread);
            }

            return $this->makeRequest('POST', $url, $options);
        } catch (\Exception $e) {
            Log::error('Failed to send message: ' . $e->getMessage(), [
                'message' => $message,
                'thread' => $thread
            ]);
            return false;
        }
    }

    public function sendDocument($message, $filePath, ?string $thread = null, $chatId = null, $keyboard = null)
    {
        try {
            if (!file_exists($filePath)) {
                Log::error('Document file not found', ['path' => $filePath]);
                return false;
            }

            $url = 'sendDocument';
            $payload = [
                [
                    'name' => 'chat_id',
                    'contents' => $chatId ?? $this->chatId
                ],
                [
                    'name' => 'parse_mode',
                    'contents' => 'HTML'
                ],
                [
                    'name' => 'document',
                    'contents' => fopen($filePath, 'r'),
                    'filename' => basename($filePath)
                ],
                [
                    'name' => 'caption',
                    'contents' => $this->prepareMessage($message)
                ]
            ];

            if ($thread && $this->getThread($thread)) {
                $payload[] = [
                    'name' => 'message_thread_id',
                    'contents' => $this->getThread($thread)
                ];
            }

            if ($keyboard) {
                $payload[] = [
                    'name' => 'reply_markup',
                    'contents' => json_encode($keyboard)
                ];
            }

            return $this->makeRequest('POST', $url, [
                'multipart' => $payload
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to send document: ' . $e->getMessage(), [
                'message' => $message,
                'file' => $filePath,
                'thread' => $thread
            ]);
            return false;
        }
    }

    public function sendMessageToChat($message, $chatId, $keyboard = null)
    {
        try {
            $url = 'sendMessage';
            $options = [
                'json' => [
                    'chat_id' => $chatId,
                    'text' => $this->prepareMessage($message),
                    'parse_mode' => 'HTML'
                ]
            ];

            if ($keyboard) {
                $options['json']['reply_markup'] = $keyboard;
            }

            return $this->makeRequest('POST', $url, $options);
        } catch (\Exception $e) {
            Log::error('Failed to send message to chat: ' . $e->getMessage(), [
                'message' => $message,
                'chat_id' => $chatId
            ]);
            return false;
        }
    }

    public function getThread($thread)
    {
        return $this->threads[$thread] ?? null;
    }

    protected function prepareMessage($message)
    {
        if (is_array($message)) {
            $message = implode("\n", $message);
        }

        return $message;
    }
}
