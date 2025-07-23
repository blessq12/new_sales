<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TelegramChat;
use App\Services\Telegram\TelegramChatFlowService;
use Illuminate\Support\Facades\Log;

class TelegramWebhookController extends Controller
{
    private $updateId;
    private $chatId;
    private $userId;
    private $userFirstName;
    private $userLastName;
    private $username;
    private $messageId;
    private $messageText;
    private $isCommand;
    private $callbackData;
    private $inlineQuery;
    private $chatType;
    private $entities;
    private $media;
    private $blacklistedChatIds = [-1002449128308];

    protected $keyboard = [
        'keyboard' => [
            [['text' => 'О компании 📄']],
            [['text' => 'Контакты 📩']],
            [['text' => 'Услуги и цены 💰']],
            [['text' => 'Оставить заявку 📝']],
            [['text' => 'Выезд и стоимость 🚗']],
            [['text' => 'Зоны обслуживания 📍']],
            [['text' => 'Grohe Сервис 🔧']]
        ],
        'resize_keyboard' => true,
        'one_time_keyboard' => false
    ];
    protected $company;
    protected $chat;
    protected $flowService;

    public function __construct()
    {
        $this->company = \App\Models\Company::first();
    }

    public function webhookHandler(Request $request)
    {
        try {
            $data = $request->all();
            Log::debug('Telegram Webhook Data: ', $data);

            $this->updateId = $data['update_id'] ?? null;
            $this->chatId = $this->extractChatId($data);

            Log::debug('Extracted chat ID: ' . $this->chatId);

            if (!$this->chatId) {
                Log::error('Chat ID is null, skipping processing.', ['data' => $data]);
                return;
            }

            if (in_array($this->chatId, $this->blacklistedChatIds)) {
                Log::info('Chat ID in blacklist: ' . $this->chatId);
                return;
            }

            $this->userId = $data['message']['from']['id'] ?? $data['callback_query']['from']['id'] ?? $data['inline_query']['from']['id'] ?? null;
            $this->userFirstName = $data['message']['from']['first_name'] ?? $data['callback_query']['from']['first_name'] ?? $data['inline_query']['from']['first_name'] ?? 'друг';
            $this->userLastName = $data['message']['from']['last_name'] ?? $data['callback_query']['from']['last_name'] ?? $data['inline_query']['from']['last_name'] ?? null;
            $this->username = $data['message']['from']['username'] ?? $data['callback_query']['from']['username'] ?? $data['inline_query']['from']['username'] ?? null;
            $this->messageId = $data['message']['message_id'] ?? $data['callback_query']['message']['message_id'] ?? null;
            $this->messageText = $data['message']['text'] ?? null;
            $this->isCommand = $this->messageText && str_starts_with($this->messageText, '/');
            $this->callbackData = $data['callback_query']['data'] ?? null;
            $this->inlineQuery = $data['inline_query']['query'] ?? null;
            $this->chatType = $data['message']['chat']['type'] ?? $data['callback_query']['message']['chat']['type'] ?? null;
            $this->entities = $data['message']['entities'] ?? null;
            $this->media = $this->parseMedia($data['message'] ?? []);

            Log::debug('Parsed webhook data:', [
                'chatId' => $this->chatId,
                'userId' => $this->userId,
                'messageText' => $this->messageText,
                'isCommand' => $this->isCommand,
                'callbackData' => $this->callbackData
            ]);

            $this->storeChat();

            Log::debug('Chat stored, initializing services...');

            $this->initializeServices();

            Log::debug('Services initialized:', [
                'chat' => $this->chat ? 'exists' : 'null',
                'flowService' => $this->flowService ? 'exists' : 'null'
            ]);

            if ($this->callbackData) {
                Log::debug('Processing callback: ' . $this->callbackData);
                $this->handleCallback($this->callbackData);
            } elseif ($this->inlineQuery) {
                Log::debug('Processing inline query: ' . $this->inlineQuery);
                $this->handleInlineQuery($this->inlineQuery);
            } elseif ($this->isCommand) {
                Log::debug('Processing command: ' . $this->messageText);
                $this->handleCommand($this->messageText);
            } elseif ($this->messageText || $this->media) {
                Log::debug('Processing message: ' . $this->messageText);
                $this->handleMessage($this->messageText);
            }
        } catch (\Exception $e) {
            Log::error('Webhook handler error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'data' => $data ?? null
            ]);
        }
    }

    private function initializeServices()
    {
        try {
            if (!$this->chat) {
                $this->chat = TelegramChat::where('chat_id', $this->chatId)->first();
                Log::debug('Chat loaded in initializeServices:', ['exists' => (bool)$this->chat]);
            }

            if ($this->chat) {
                $this->flowService = new TelegramChatFlowService($this->chat);
                Log::debug('Flow service initialized in initializeServices');
            } else {
                Log::warning('Cannot initialize flow service - chat not found');
            }
        } catch (\Exception $e) {
            Log::error('Failed to initialize services: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
        }
    }

    private function extractChatId(array $data): ?int
    {
        return $data['message']['chat']['id'] ??
            $data['callback_query']['message']['chat']['id'] ??
            $data['inline_query']['chat']['id'] ??
            null;
    }

    private function parseMedia(array $message): ?array
    {
        $media = [];
        if (isset($message['photo'])) $media['photo'] = $message['photo'];
        if (isset($message['video'])) $media['video'] = $message['video'];
        if (isset($message['document'])) $media['document'] = $message['document'];
        if (isset($message['sticker'])) $media['sticker'] = $message['sticker'];
        if (isset($message['voice'])) $media['voice'] = $message['voice'];
        return !empty($media) ? $media : null;
    }

    private function storeChat()
    {
        try {
            Log::debug('Storing chat data:', [
                'chat_id' => $this->chatId,
                'user_id' => $this->userId,
                'first_name' => $this->userFirstName,
                'last_name' => $this->userLastName
            ]);

            // Сначала пробуем найти существующий чат
            $this->chat = TelegramChat::where('chat_id', $this->chatId)->first();

            if (!$this->chat) {
                // Если чат не найден, создаём новый
                $this->chat = new TelegramChat();
                $this->chat->chat_id = $this->chatId;
            }

            // Обновляем данные
            $this->chat->user_id = $this->userId;
            $this->chat->first_name = $this->userFirstName;
            $this->chat->last_name = $this->userLastName;
            $this->chat->username = $this->username;
            $this->chat->chat_type = $this->chatType;
            $this->chat->last_message = $this->messageText;
            $this->chat->last_message_id = $this->messageId;
            $this->chat->media = $this->media ? json_encode($this->media) : null;
            $this->chat->entities = $this->entities ? json_encode($this->entities) : null;

            $saved = $this->chat->save();

            Log::debug('Chat ' . ($this->chat->wasRecentlyCreated ? 'created' : 'updated') . ':', [
                'success' => $saved,
                'chat_id' => $this->chat->chat_id,
                'id' => $this->chat->id
            ]);

            // Инициализируем сервис сразу после сохранения чата
            if ($saved && $this->chat) {
                $this->flowService = new TelegramChatFlowService($this->chat);
                Log::debug('Flow service initialized');
            }
        } catch (\Exception $e) {
            Log::error('Failed to store chat: ' . $e->getMessage(), [
                'chat_id' => $this->chatId,
                'user_id' => $this->userId,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
        }
    }

    private function handleCommand($message)
    {
        $command = substr($message, 1);
        switch ($command) {
            case 'start':
                $this->handleStartCommand();
                break;
            default:
                $this->handleDefaultCommand();
                break;
        }
    }

    private function handleStartCommand()
    {
        $message = [
            "Привет, {$this->userFirstName}!",
            "Наша компания предоставляет широкий спектр услуг по установке и ремонту сантехники. ",
            "Выбери опцию на клавиатуре ниже. Работаем в Томске, Северске и пригороде +300 км.",
            "",
            "Если нет того, что тебе нужно, вот наши контакты:",
            "",
            "🌐 Сайт: {$this->company->website}",
            "",
            "📞 Телефон: {$this->company->phones[0]}",
            "📧 Email: {$this->company->emails[0]}",
        ];
        (new \App\Services\Telegram\TelegramMessageService())->sendMessageToChat(
            $message,
            $this->chatId,
            $this->keyboard
        );
    }

    private function handleDefaultCommand()
    {
        (new \App\Services\Telegram\TelegramMessageService())->sendMessageToChat(
            "Не знаю такой команды, {$this->userFirstName}. Попробуй /start или выбери опцию на клавиатуре.",
            $this->chatId,
            $this->keyboard
        );
    }

    private function handleMessage($message)
    {
        // Если у чата есть активное состояние флоу и это состояние contact_info
        if ($this->chat && $this->chat->flow_state === 'contact_info') {
            $this->flowService->handleContactInfo($message);
            return;
        }

        if ($this->media) {
            $response = "Получил медиа, {$this->userFirstName}! Пока не знаю, что с этим делать.";
            (new \App\Services\Telegram\TelegramMessageService())->sendMessageToChat(
                $response,
                $this->chatId,
                $this->keyboard
            );
            return;
        }

        switch ($message) {
            case 'О компании 📄':
                $this->handleAboutCompany();
                break;
            case 'Контакты 📩':
                $this->handleContacts();
                break;
            case 'Услуги и цены 💰':
                $this->handleServicesAndPrices();
                break;
            case 'Оставить заявку 📝':
                $this->flowService->startServiceFlow();
                break;
            case 'Выезд и стоимость 🚗':
                $this->handleServiceAndPrice();
                break;
            case 'Зоны обслуживания 📍':
                $this->handleServiceArea();
                break;
            case 'Grohe Сервис 🔧':
                $this->handleGroheService();
                break;
            default:
                $this->handleUnknownMessage();
        }
    }

    private function handleAboutCompany()
    {
        $socials = [];
        foreach ($this->company->socials as $social) {
            $socials[] = "📱 {$social['title']}: {$social['url']}";
        }

        $response = [
            "ООО {$this->company->name} — лидер в сфере сантехнических услуг с 2000 года",
            "Мы предоставляем качественный сервис по установке и ремонту сантехники.",
            "",
            "Мы в социальных сетях:",
        ];

        $response = array_merge($response, $socials);

        (new \App\Services\Telegram\TelegramMessageService())->sendMessageToChat(
            $response,
            $this->chatId,
            $this->keyboard
        );
    }

    private function handleContacts()
    {
        $phones = [];

        foreach ($this->company->phones as $phone) {
            $phones[] = "📞 Телефон: {$phone}";
        }

        $emails = [];
        foreach ($this->company->emails as $email) {
            $emails[] = "📧 Email: {$email}";
        }

        $legals = [];
        foreach ($this->company->legals as $legal) {
            $legals[] = "📄 {$legal->name}";
            $legals[] = "📄 ИНН: {$legal->inn}";
            $legals[] = "📄 КПП: {$legal->kpp}";
            $legals[] = "📄 Банк: {$legal->bank}";
            $legals[] = "📄 БИК: {$legal->bik}";
            $legals[] = "📄 Номер счета: {$legal->account_number}";
            $legals[] = "📄 Корр. счет: {$legal->correspondent_account}";
            $legals[] = "";
        }

        $response = [
            "Связаться с нами, {$this->userFirstName}:",
            "",
            ...$phones,
            "",
            ...$emails,
            "",
            "🌐 Сайт: {$this->company->website}",
            "",
            "Данные организации:",
            "",
            ...$legals,
        ];
        (new \App\Services\Telegram\TelegramMessageService())->sendMessageToChat(
            $response,
            $this->chatId,
            $this->keyboard
        );
    }

    private function handleServicesAndPrices()
    {
        $response = [
            "Скачай прайс-лист ниже чтобы ознакомиться с нашими услугами и ценами",
            "",
            "Прайс-лист актуален на " . date('d.m.Y'),
        ];

        $filepath = $this->downloadPrice();

        if (file_exists($filepath)) {
            (new \App\Services\Telegram\TelegramMessageService())->sendDocument(
                $response,
                $filepath,
                null,
                $this->chatId,
                $this->keyboard
            );
        } else {
            (new \App\Services\Telegram\TelegramMessageService())->sendMessageToChat(
                "$response\nК сожалению, прайс-лист временно недоступен.",
                $this->chatId,
                $this->keyboard
            );
        }
    }

    private function handleRequest()
    {
        $response = [
            "Опиши, что нужно, {$this->userFirstName}, и мы свяжемся!",
            "Например: адрес, тип услуги (установка, ремонт), удобное время.",
            "(Пока я не сохраняю заявки, просто напиши для теста.)"
        ];
        (new \App\Services\Telegram\TelegramMessageService())->sendMessageToChat(
            $response,
            $this->chatId,
            $this->keyboard
        );
    }

    private function handleServiceAndPrice()
    {
        $response = [
            "<b>Выезд и стоимость</b>",
            "",
            "Выезд для оказания профессиональной помощи осуществляется в следующих условиях:",
            "",
            "<b>Выезд в Томск/Северск:</b>",
            "Стоимость составляет от 3000 рублей. Специалисты прибудут в назначенное время с необходимым оборудованием для выполнения работы.",
            "",
            "<b>Выезд за город:</b>",
            "Стоимость составляет 100 рублей за каждый километр. Выезд возможен на любое расстояние в соответствии с потребностями клиента.",
            "",
            "Для получения дополнительной информации и записи на выезд, пожалуйста, свяжитесь с нами.",
            "",
            "<b>Телефон:</b> {$this->company->phones[0]}",
            "<b>Email:</b> {$this->company->emails[0]}",
            "<b>Сайт:</b> {$this->company->website}"
        ];
        (new \App\Services\Telegram\TelegramMessageService())->sendMessageToChat(
            $response,
            $this->chatId,
            $this->keyboard
        );
    }

    private function handleServiceArea()
    {
        $response = [
            "<b>Районы города Томск:</b>",
            "Кировский район, Октябрьский район, Ленинский район, Академгородок, Советский район",
            "",
            "<b>Работаем по всему Северску</b>",
            "",
            "<b>Пригороды Томска (до 300 км):</b>",
            "Тимирязево, Зональный, Черная речка, Кисловка, Дзержинское, Зоркальцево, Слобода Вольная, Тахтамышево, Кафтанчиково, Лучаново, Березкино, Поросино, Светлый, Копылово, Рассвет, Воронино, Корнилово, Мирный, Кузовлево, Сосновый Бор, Спутник, Новомихайловка, Лязгино, Трубачево, Позднеево, Ключи, Апрель, Просторный, Лоскутово, Богашёво, Синий Утёс, Коларово"
        ];
        (new \App\Services\Telegram\TelegramMessageService())->sendMessageToChat(
            $response,
            $this->chatId,
            $this->keyboard
        );
    }

    private function handleGroheService()
    {
        $response = [
            "<b>Эксперты в ремонте и установке сантехники GROHE</b>",
            "",
            "🛡️ Мы — официальный представитель GROHE в Томске",
            "",
            "<b>Наши преимущества:</b>",
            "⚡️ Быстрый выезд в течение 30 минут по всей Томской области",
            "🛡️ Гарантия на все виды работ и запчасти",
            "💰 Честные цены, озвучиваем до начала работ",
            "🔧 10+ лет опыта работы с GROHE",
            "",
            "<b>Услуги:</b>",
            "• Установка сантехники GROHE",
            "• Ремонт смесителей и душевых систем",
            "• Замена картриджей",
            "• Монтаж инсталляций",
            "• Работа с системами любой сложности",
            "",
            "Контакты:",
            "",
            "<b>Телефон:</b> {$this->company->phones[0]}",
            "<b>Email:</b> {$this->company->emails[0]}",
            "<b>Сайт:</b> {$this->company->website}"
        ];
        (new \App\Services\Telegram\TelegramMessageService())->sendMessageToChat(
            $response,
            $this->chatId,
            $this->keyboard
        );
    }

    private function handleUnknownMessage()
    {
        $response = "Я не понимаю, о чём ты, {$this->userFirstName}. Используй кнопки на клавиатуре!";
        (new \App\Services\Telegram\TelegramMessageService())->sendMessageToChat(
            $response,
            $this->chatId,
            $this->keyboard
        );
    }

    private function handleCallback($callbackData)
    {
        // Если это кнопка возврата
        if (str_starts_with($callbackData, 'back_')) {
            switch ($callbackData) {
                case 'back_categories':
                    $this->flowService->startServiceFlow();
                    break;
                case 'back_services':
                    $flowData = json_decode($this->chat->flow_data, true);
                    $this->flowService->handleCategorySelection($flowData['category_id']);
                    break;
            }
            return;
        }

        // Обработка остальных callback'ов через сервис
        if ($this->chat && $this->chat->flow_state) {
            $this->flowService->processCallback($callbackData);
            return;
        }

        // Если не обработано выше, отправляем дефолтный ответ
        (new \App\Services\Telegram\TelegramMessageService())->sendMessageToChat(
            "Получен неизвестный callback: $callbackData",
            $this->chatId,
            $this->keyboard
        );
    }

    private function handleInlineQuery($query)
    {
        (new \App\Services\Telegram\TelegramMessageService())->sendMessageToChat(
            "Инлайн-запрос от {$this->userFirstName}: $query",
            $this->chatId,
            $this->keyboard
        );
    }

    private function downloadPrice()
    {
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML(view('services.price.pdf', [
            'categories' => \App\Models\ServiceCategory::all(),
            'company' => \App\Models\Company::first(),
        ])->render());

        $pdfContent = $mpdf->Output('price.pdf', 'S');
        $filepath = storage_path('app/public/price.pdf');
        file_put_contents($filepath, $pdfContent);

        return $filepath;
    }
}
