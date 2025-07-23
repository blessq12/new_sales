<?php

namespace App\Services\Telegram;

use App\Models\TelegramChat;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\Lead;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;

class TelegramChatFlowService
{
    protected $flows;
    protected $chat;
    protected $messageService;

    public function __construct(TelegramChat $chat)
    {
        $this->flows = Config::get('chatbot.flows');
        $this->chat = $chat;
        $this->messageService = new TelegramMessageService();
    }

    public function startServiceFlow()
    {
        $this->chat->update(['flow_state' => 'service_selection']);

        $categories = ServiceCategory::select('id', 'name', 'slug')->get();
        $buttons = [];
        foreach ($categories as $category) {
            $buttons[] = [
                ['text' => $category->name, 'callback_data' => "category_{$category->id}"]
            ];
        }

        $keyboard = [
            'inline_keyboard' => $buttons
        ];

        $message = [
            "Выберите категорию услуг:",
            "",
            "После выбора категории я покажу доступные услуги."
        ];

        $this->messageService->sendMessageToChat($message, $this->chat->chat_id, $keyboard);
    }

    public function processCallback($callbackData)
    {
        $parts = explode('_', $callbackData);
        $type = $parts[0];
        $value = $parts[1];

        switch ($this->chat->flow_state) {
            case 'service_selection':
                if ($type === 'category') {
                    return $this->handleCategorySelection($value);
                }
                break;
            case 'service_details':
                if ($type === 'service') {
                    return $this->handleServiceSelection($value);
                }
                break;
            case 'timing':
                if ($type === 'time') {
                    return $this->handleTimingSelection($value);
                }
                break;
        }

        return false;
    }

    protected function handleCategorySelection($categoryId)
    {
        $this->chat->update([
            'flow_state' => 'service_details',
            'flow_data' => json_encode(['category_id' => $categoryId])
        ]);

        $services = Service::where('service_category_id', $categoryId)
            ->select('id', 'name', 'slug', 'price')
            ->get();

        $buttons = [];
        foreach ($services as $service) {
            $buttons[] = [
                ['text' => "{$service->name} - {$service->price}₽", 'callback_data' => "service_{$service->id}"]
            ];
        }
        $buttons[] = [['text' => '« Назад к категориям', 'callback_data' => 'back_categories']];

        $keyboard = [
            'inline_keyboard' => $buttons
        ];

        $message = [
            "Выберите интересующую услугу:",
            "",
            "Цены указаны за базовую стоимость работ."
        ];

        $this->messageService->sendMessageToChat($message, $this->chat->chat_id, $keyboard);
        return true;
    }

    protected function handleServiceSelection($serviceId)
    {
        $this->chat->update([
            'flow_state' => 'timing',
            'flow_data' => json_encode([
                'category_id' => json_decode($this->chat->flow_data)->category_id,
                'service_id' => $serviceId
            ])
        ]);

        $buttons = [
            [['text' => 'Как можно скорее', 'callback_data' => 'time_asap']],
            [['text' => 'Сегодня', 'callback_data' => 'time_today']],
            [['text' => 'Завтра', 'callback_data' => 'time_tomorrow']],
            [['text' => 'В течение недели', 'callback_data' => 'time_week']],
            [['text' => '« Назад к услугам', 'callback_data' => 'back_services']]
        ];

        $keyboard = [
            'inline_keyboard' => $buttons
        ];

        $message = [
            "Когда вам удобно принять мастера?",
            "",
            "Выберите примерное время:"
        ];

        $this->messageService->sendMessageToChat($message, $this->chat->chat_id, $keyboard);
        return true;
    }

    protected function handleTimingSelection($timing)
    {
        $this->chat->update([
            'flow_state' => 'contact_info',
            'flow_data' => json_encode([
                'category_id' => json_decode($this->chat->flow_data)->category_id,
                'service_id' => json_decode($this->chat->flow_data)->service_id,
                'timing' => $timing
            ])
        ]);

        $message = [
            "Отлично! Для оформления заявки мне нужны ваши контактные данные.",
            "",
            "Пожалуйста, отправьте ваше имя и номер телефона в формате:",
            "Иван, +79991234567"
        ];

        $this->messageService->sendMessageToChat($message, $this->chat->chat_id);
        return true;
    }

    public function handleContactInfo($messageText)
    {
        if (!$this->chat->flow_state === 'contact_info') {
            return false;
        }

        try {
            // Парсим имя и телефон из сообщения
            $parts = array_map('trim', explode(',', $messageText));
            if (count($parts) !== 2) {
                throw new \Exception('Неверный формат данных');
            }

            $name = $parts[0];
            $phone = $parts[1];

            // Получаем сохранённые данные
            $flowData = json_decode($this->chat->flow_data, true);

            // Создаём лид
            $lead = Lead::create([
                'name' => $name,
                'phone' => $phone,
                'service_id' => $flowData['service_id'],
                'timing' => $flowData['timing'],
                'chat_history' => array_merge($flowData, [
                    'name' => $name,
                    'phone' => $phone,
                    'source' => 'telegram',
                    'chat_id' => $this->chat->chat_id
                ])
            ]);

            // Отправляем уведомление в админский чат
            $service = Service::find($flowData['service_id']);
            $message = [
                "🔔 Новая заявка из Telegram!",
                "",
                "👤 Имя: {$name}",
                "📞 Телефон: {$phone}",
                "🔧 Услуга: " . ($service ? $service->name : 'Не указана'),
                "⏰ Время: {$flowData['timing']}",
            ];

            $this->messageService->sendMessage($message, 'order');

            // Отправляем подтверждение клиенту
            $message = [
                "✅ Спасибо за заявку!",
                "",
                "Мы свяжемся с вами в ближайшее время для уточнения деталей.",
                "",
                "Если у вас появятся вопросы, вы можете написать их здесь."
            ];

            $this->messageService->sendMessageToChat($message, $this->chat->chat_id);

            // Сбрасываем состояние
            $this->chat->update([
                'flow_state' => null,
                'flow_data' => null
            ]);

            return true;
        } catch (\Exception $e) {
            Log::error('Failed to process contact info: ' . $e->getMessage(), [
                'message' => $messageText,
                'chat_id' => $this->chat->chat_id,
                'flow_data' => $this->chat->flow_data
            ]);

            $message = [
                "❌ Извините, но я не смог обработать ваши данные.",
                "",
                "Пожалуйста, отправьте имя и телефон в формате:",
                "Иван, +79991234567"
            ];

            $this->messageService->sendMessageToChat($message, $this->chat->chat_id);
            return false;
        }
    }
}
