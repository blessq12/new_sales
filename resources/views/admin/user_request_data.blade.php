<ul>
    @foreach ($data as $k => $v)
        @php
            $key = match ($k) {
                'name' => 'Имя',
                'phone' => 'Телефон',
                'email' => 'Email',
                'message' => 'Сообщение',
                'type' => 'Тип запроса',
                'date' => 'Дата',
                'time' => 'Время',
                'address' => 'Адрес',
                'delivery_type' => 'Тип доставки',
                'payment_type' => 'Тип оплаты',
                'delivery_price' => 'Стоимость доставки',
                'delivery_time' => 'Время доставки',
                'privacy' => 'Согласие на обработку персональных данных',
                'agree' => 'Согласие на обработку персональных данных',
                'service_name' => 'Название услуги',
                'comment' => 'Комментарий',
                default => $k,
            };
        @endphp
        <li>
            <b>{{ $key }}</b>: 
            {{ $v }}
        </li>
    @endforeach
</ul>
