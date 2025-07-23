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
        try {
            Log::debug('Starting service flow');

            // Сохраняем состояние
            $this->chat->flow_state = 'service_selection';
            $this->chat->flow_data = null;
            $this->chat->save();

            Log::debug('Flow state updated', [
                'state' => $this->chat->flow_state,
                'chat_id' => $this->chat->chat_id
            ]);

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
        } catch (\Exception $e) {
            Log::error('Failed to start service flow: ' . $e->getMessage(), [
                'chat_id' => $this->chat->chat_id,
                'trace' => $e->getTraceAsString()
            ]);
        }
    }

    public function processCallback($callbackData)
    {
        try {
            Log::debug('Processing callback', [
                'callback' => $callbackData,
                'current_state' => $this->chat->flow_state,
                'chat_id' => $this->chat->chat_id
            ]);

            $parts = explode('_', $callbackData);
            if (count($parts) !== 2) {
                Log::warning('Invalid callback data format', ['callback' => $callbackData]);
                return false;
            }

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

            Log::warning('Unhandled callback', [
                'type' => $type,
                'value' => $value,
                'state' => $this->chat->flow_state
            ]);

            return false;
        } catch (\Exception $e) {
            Log::error('Failed to process callback: ' . $e->getMessage(), [
                'callback' => $callbackData,
                'chat_id' => $this->chat->chat_id,
                'trace' => $e->getTraceAsString()
            ]);
            return false;
        }
    }

    protected function handleCategorySelection($categoryId)
    {
        try {
            Log::debug('Handling category selection', [
                'category_id' => $categoryId,
                'chat_id' => $this->chat->chat_id
            ]);

            // Сохраняем состояние и данные
            $this->chat->flow_state = 'service_details';
            $this->chat->flow_data = json_encode(['category_id' => $categoryId]);
            $this->chat->save();

            Log::debug('Flow state updated', [
                'state' => $this->chat->flow_state,
                'data' => $this->chat->flow_data
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

            return $this->messageService->sendMessageToChat($message, $this->chat->chat_id, $keyboard);
        } catch (\Exception $e) {
            Log::error('Failed to handle category selection: ' . $e->getMessage(), [
                'category_id' => $categoryId,
                'chat_id' => $this->chat->chat_id,
                'trace' => $e->getTraceAsString()
            ]);
            return false;
        }
    }

    protected function handleServiceSelection($serviceId)
    {
        try {
            Log::debug('Handling service selection', [
                'service_id' => $serviceId,
                'chat_id' => $this->chat->chat_id
            ]);

            $flowData = json_decode($this->chat->flow_data, true);
            $flowData['service_id'] = $serviceId;

            $this->chat->flow_state = 'timing';
            $this->chat->flow_data = json_encode($flowData);
            $this->chat->save();

            Log::debug('Flow state updated', [
                'state' => $this->chat->flow_state,
                'data' => $this->chat->flow_data
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

            return $this->messageService->sendMessageToChat($message, $this->chat->chat_id, $keyboard);
        } catch (\Exception $e) {
            Log::error('Failed to handle service selection: ' . $e->getMessage(), [
                'service_id' => $serviceId,
                'chat_id' => $this->chat->chat_id,
                'trace' => $e->getTraceAsString()
            ]);
            return false;
        }
    }

    protected function handleTimingSelection($timing)
    {
        try {
            Log::debug('Handling timing selection', [
                'timing' => $timing,
                'chat_id' => $this->chat->chat_id
            ]);

            $flowData = json_decode($this->chat->flow_data, true);
            $flowData['timing'] = $timing;

            $this->chat->flow_state = 'contact_info';
            $this->chat->flow_data = json_encode($flowData);
            $this->chat->save();

            Log::debug('Flow state updated', [
                'state' => $this->chat->flow_state,
                'data' => $this->chat->flow_data
            ]);

            $message = [
                "Отлично! Для оформления заявки мне нужны ваши контактные данные.",
                "",
                "Пожалуйста, отправьте ваше имя и номер телефона в формате:",
                "Иван, +79991234567"
            ];

            return $this->messageService->sendMessageToChat($message, $this->chat->chat_id);
        } catch (\Exception $e) {
            Log::error('Failed to handle timing selection: ' . $e->getMessage(), [
                'timing' => $timing,
                'chat_id' => $this->chat->chat_id,
                'trace' => $e->getTraceAsString()
            ]);
            return false;
        }
    }

    public function handleContactInfo($messageText)
    {
        try {
            Log::debug('Handling contact info', [
                'message' => $messageText,
                'chat_id' => $this->chat->chat_id,
                'state' => $this->chat->flow_state
            ]);

            if ($this->chat->flow_state !== 'contact_info') {
                Log::warning('Invalid state for contact info', [
                    'current_state' => $this->chat->flow_state
                ]);
                return false;
            }

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

            Log::debug('Lead created', ['lead_id' => $lead->id]);

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
            $this->chat->flow_state = null;
            $this->chat->flow_data = null;
            $this->chat->save();

            Log::debug('Flow completed and reset');

            return true;
        } catch (\Exception $e) {
            Log::error('Failed to process contact info: ' . $e->getMessage(), [
                'message' => $messageText,
                'chat_id' => $this->chat->chat_id,
                'flow_data' => $this->chat->flow_data,
                'trace' => $e->getTraceAsString()
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
