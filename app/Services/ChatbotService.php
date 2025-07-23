<?php

namespace App\Services;

use App\Models\Lead;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;

class ChatbotService
{
    protected $flows;
    protected $sessionData;

    public function __construct()
    {
        $this->flows = Config::get('chatbot.flows');
        $this->sessionData = [];
    }

    public function startChat()
    {
        $step = $this->flows['service_selection'];
        $step['data'] = ServiceCategory::select('id', 'name', 'slug')->get();
        return $step;
    }

    public function processStep($stepId, $answer, $sessionId)
    {
        // Загружаем или инициализируем данные сессии
        $this->sessionData = session()->get("chatbot.{$sessionId}", []);

        // Сохраняем ответ в зависимости от типа шага
        switch ($stepId) {
            case 'service_selection':
                // Для выбора категории сохраняем ID категории
                $this->sessionData['category_id'] = $answer;
                break;
            case 'service_details':
                // Для выбора услуги сохраняем ID услуги
                $this->sessionData['service_id'] = $answer;
                break;
            case 'timing':
                // Для выбора времени сохраняем значение
                $this->sessionData['timing'] = $answer;
                break;
            case 'contact_info':
                // Для контактных данных сохраняем все переданные данные
                foreach ($answer as $key => $value) {
                    $this->sessionData[$key] = $value;
                }
                break;
        }

        session()->put("chatbot.{$sessionId}", $this->sessionData);

        // Получаем текущий шаг
        $currentStep = $this->flows[$stepId];

        // Если это последний шаг - сохраняем лид
        if ($currentStep['type'] === 'contact_form') {
            return $this->saveLead($answer, $sessionId);
        }

        // Получаем следующий шаг
        $nextStep = $this->flows[$currentStep['next']];

        // Добавляем данные в зависимости от типа шага
        switch ($nextStep['type']) {
            case 'service_select':
                $categoryId = $this->sessionData['category_id'];
                $nextStep['data'] = Service::where('service_category_id', $categoryId)
                    ->select('id', 'name', 'slug', 'price')
                    ->get();
                break;
            case 'button_select':
                $nextStep['data'] = $nextStep['options'];
                break;
            case 'contact_form':
                $nextStep['data'] = null;
                break;
        }

        return $nextStep;
    }

    protected function saveLead($contactData, $sessionId)
    {
        $sessionData = session()->get("chatbot.{$sessionId}");

        try {
            if (!isset($sessionData['service_id']) || !isset($sessionData['timing'])) {
                throw new \Exception('Не хватает данных для создания заявки');
            }

            $lead = Lead::create([
                'name' => $sessionData['name'],
                'phone' => $sessionData['phone'],
                'service_id' => $sessionData['service_id'],
                'timing' => $sessionData['timing'],
                'chat_history' => $sessionData
            ]);

            if (class_exists('\App\Services\Telegram\TelegramMessageService')) {
                $service = Service::find($sessionData['service_id']);
                $message = [
                    "🔔 Новая заявка из чат-бота!",
                    "",
                    "👤 Имя: {$sessionData['name']}",
                    "📞 Телефон: {$sessionData['phone']}",
                    "🔧 Услуга: " . ($service ? $service->name : 'Не указана'),
                    "⏰ Время: {$sessionData['timing']}",
                ];

                (new \App\Services\Telegram\TelegramMessageService())->sendMessage($message, 'order');
            }

            // Очищаем сессию
            session()->forget("chatbot.{$sessionId}");

            // Возвращаем финальный шаг
            return $this->flows['finish'];
        } catch (\Exception $e) {
            Log::error('Chatbot lead creation error: ' . $e->getMessage(), [
                'contact_data' => $contactData,
                'session_data' => $sessionData
            ]);

            throw new \Exception('Не удалось сохранить заявку. Попробуйте позже.');
        }
    }
}
