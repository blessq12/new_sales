<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Прайс-лист {{ $company->name }}</title>
    <style>
        @page {
            margin: 2cm 1.5cm;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11pt;
            line-height: 1.4;
            color: #000;
            background-color: #fff;
            margin: 0;
            padding: 0;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 1px solid #000;
            padding-bottom: 10px;
        }

        .logo {
            max-width: 100px;
            margin-bottom: 10px;
        }

        h1 {
            font-size: 18pt;
            margin: 5px 0;
            font-weight: bold;
        }

        .company-info {
            margin-bottom: 20px;
            font-size: 10pt;
        }

        .company-info h2 {
            font-size: 14pt;
            margin-top: 0;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .company-info p {
            margin: 3px 0;
        }

        .legal-info {
            font-size: 9pt;
            color: #333;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            padding: 6px 8px;
            text-align: left;
            border: 1px solid #000;
        }

        th {
            background-color: #eee;
            font-weight: bold;
            font-size: 10pt;
        }

        .category-name {
            background-color: #ddd;
            font-weight: bold;
            font-size: 11pt;
        }

        .price {
            text-align: right;
            white-space: nowrap;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 9pt;
            color: #333;
            border-top: 1px solid #000;
            padding-top: 10px;
        }

        .footer p {
            margin: 3px 0;
        }
    </style>
</head>

<body>
    <div class="header">
        @if ($company->logo)
            <img src="{{ '/assets/images/logo.png' }}" alt="{{ $company->name }}" class="logo">
        @endif
        <h1>ПРАЙС-ЛИСТ</h1>
        <div>{{ $company->name ?: 'ООО "Салес"' }}</div>
    </div>

    <div class="company-info">
        <h2>Цены на {{ date('d.m.Y') }}</h2>
        @if ($company->phones)
            <p><strong>Телефон:</strong> {{ implode(', ', $company->phones) }}</p>
        @endif
        @if ($company->emails)
            <p><strong>Email:</strong> {{ implode(', ', $company->emails) }}</p>
        @endif
        @if ($company->addresses)
            <p><strong>Адрес:</strong> {{ implode(', ', $company->addresses) }}</p>
        @endif
    </div>

    <div class="legal-info">
        @foreach ($company->legals as $legal)
            <p><strong>{{ $legal->name }}:</strong> {{ $legal->value }}</p>
        @endforeach
    </div>

    <table>
        <thead>
            <tr>
                <th>Услуга</th>
                <th>Описание</th>
                <th>Цена</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td colspan="3" class="category-name">{{ $category->name }}</td>
                </tr>
                @foreach ($category->services as $service)
                    <tr>
                        <td>{{ $service->name }}</td>
                        <td>{{ $service->description }}</td>
                        <td class="price">{{ $service->prefix }} {{ number_format($service->price, 0, '.', ' ') }}
                            руб.
                        </td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Цены действительны на {{ date('d.m.Y') }}</p>
    </div>
</body>

</html>
