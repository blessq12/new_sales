<?php

return [
    'flows' => [
        'service_selection' => [
            'id' => 'service_selection',
            'message' => 'Привет! 👋 Я помогу вам заказать сантехнические услуги. Выберите категорию:',
            'type' => 'category_select',
            'next' => 'service_details'
        ],
        'service_details' => [
            'id' => 'service_details',
            'message' => 'Отлично! Теперь выберите конкретную услугу:',
            'type' => 'service_select',
            'next' => 'timing'
        ],
        'timing' => [
            'id' => 'timing',
            'message' => 'Когда вам удобно, чтобы мастер приехал?',
            'type' => 'button_select',
            'options' => [
                'as_soon' => 'Как можно скорее',
                'today' => 'Сегодня',
                'tomorrow' => 'Завтра',
                'later' => 'В другой день'
            ],
            'next' => 'contact_info'
        ],
        'contact_info' => [
            'id' => 'contact_info',
            'message' => 'Отлично! Для завершения заказа, пожалуйста, оставьте ваши контакты:',
            'type' => 'contact_form',
            'fields' => [
                'name' => 'Ваше имя',
                'phone' => 'Номер телефона'
            ],
            'next' => 'finish'
        ],
        'finish' => [
            'id' => 'finish',
            'message' => 'Спасибо! Мы свяжемся с вами в ближайшее время для подтверждения заказа. 🚀',
            'type' => 'final',
            'next' => null
        ]
    ]
];
