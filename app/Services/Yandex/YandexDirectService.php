<?php

namespace App\Services\Yandex;

use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\Company;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Illuminate\Support\Facades\Log;

class YandexDirectService
{
    private $company;

    public function __construct()
    {
        $this->company = Company::first();
    }

    public function generateXlsx(): string
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Тексты');

        // Заголовки из референса
        $headers = [
            'Доп. объявление группы',
            'Тип объявления',
            'Название группы',
            'Номер группы',
            'Фраза (с минус-словами)',
            'Заголовок 1',
            'Заголовок 2',
            'Текст',
            'Ссылка',
            'Отображаемая ссылка',
            'Регион',
            'Заголовки быстрых ссылок',
            'Описания быстрых ссылок',
            'Адреса быстрых ссылок',
            'Уточнения',
            'Минус-фразы на группу',
            'Метки'
        ];

        // Стили для заголовков
        $headerStyle = [
            'font' => ['bold' => true, 'size' => 11],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'E0E0E0']],
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER]
        ];

        // Записываем заголовки
        foreach ($headers as $col => $header) {
            $cell = chr(65 + $col) . '1';
            $sheet->setCellValue($cell, $header);
            $sheet->getStyle($cell)->applyFromArray($headerStyle);
        }

        $row = 2;
        $groupNumber = 1;

        // Получаем активные услуги
        $services = Service::where('status', 'active')->get();
        Log::info('Found services: ' . $services->count());

        foreach ($services as $service) {
            $category = $service->category;
            Log::info('Processing service: ' . $service->name . ', keywords: ' . json_encode($service->keywords));

            // Если нет ключевых слов, создаем одно объявление без фраз
            $keywords = !empty($service->keywords) ? $service->keywords : [''];

            foreach ($keywords as $index => $keyword) {
                Log::info('Adding keyword for service: ' . $keyword);

                // Главное объявление ('-') для первого ключевого слова, дополнительное ('+') для остальных
                $sheet->setCellValue('A' . $row, $index === 0 ? '-' : '+');
                $sheet->setCellValue('B' . $row, 'Текстово-графическое');
                $sheet->setCellValue('C' . $row, $this->truncate($service->name, 56)); // Название группы
                $sheet->setCellValue('D' . $row, $groupNumber); // Номер группы
                $sheet->setCellValue('E' . $row, $index === 0 ? $this->truncate($keyword, 4096) : ''); // Фраза (только для главного)
                $sheet->setCellValue('F' . $row, $this->truncate($service->name, 56)); // Заголовок 1
                $sheet->setCellValue('G' . $row, $this->truncate($service->prefix . ' ' . $service->price, 30)); // Заголовок 2
                $sheet->setCellValue('H' . $row, $this->truncate($service->description, 81)); // Текст
                $sheet->setCellValue('I' . $row, route('services.show', ['category' => $category->slug, 'slug' => $service->slug])); // Ссылка
                $sheet->setCellValue('J' . $row, $this->truncate(parse_url($this->company->website, PHP_URL_HOST), 20)); // Отображаемая ссылка
                $sheet->setCellValue('K' . $row, $this->company->city ?? 'Центр'); // Регион

                // Быстрые ссылки
                $relatedServices = $category->services()
                    ->where('status', 'active')
                    ->where('id', '!=', $service->id)
                    ->take(4)
                    ->get();
                $quickLinks = [];
                $quickLinksDesc = [];
                $quickLinksUrls = [];

                foreach ($relatedServices as $related) {
                    $quickLinks[] = $this->truncate($related->name, 30);
                    $quickLinksDesc[] = $this->truncate($related->description, 60);
                    $quickLinksUrls[] = route('services.show', ['category' => $category->slug, 'slug' => $related->slug]);
                }

                $sheet->setCellValue('L' . $row, implode('||', $quickLinks)); // Заголовки быстрых ссылок
                $sheet->setCellValue('M' . $row, implode('||', $quickLinksDesc)); // Описания
                $sheet->setCellValue('N' . $row, implode('||', $quickLinksUrls)); // Адреса

                // Уточнения
                $clarifications = [
                    'Выезд ' . ($this->company->city ?? 'по городу'),
                    'От ' . $service->price . ' ₽',
                    'Гарантия на работы',
                    'Опытные мастера'
                ];
                $sheet->setCellValue('O' . $row, implode('||', array_map(fn($c) => $this->truncate($c, 25), $clarifications)));

                // Минус-фразы на группу
                $minusPhrases = $category->minus_phrases ?? '-бесплатно -акция';
                $sheet->setCellValue('P' . $row, $this->truncate($minusPhrases, 4096));

                // Метки
                $tags = ['услуга_' . $service->id, 'категория_' . $category->id];
                $sheet->setCellValue('Q' . $row, implode(',', array_map(fn($t) => $this->truncate($t, 25), $tags)));

                $row++;
            }

            $groupNumber++; // Увеличиваем номер группы для следующей услуги
        }

        // Автоматическая ширина столбцов
        foreach (range('A', 'Q') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Стили для данных
        $dataStyle = [
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
            'alignment' => ['vertical' => Alignment::VERTICAL_TOP, 'wrapText' => true]
        ];
        $sheet->getStyle('A2:Q' . ($row - 1))->applyFromArray($dataStyle);

        // Сохраняем файл
        $tempFile = tempnam(sys_get_temp_dir(), 'yandex_direct_');
        $writer = new Xlsx($spreadsheet);
        $writer->save($tempFile);

        return $tempFile;
    }

    private function truncate(string $text, int $length): string
    {
        if (empty($text)) {
            return '';
        }
        if (mb_strlen($text) <= $length) {
            return $text;
        }
        return mb_substr($text, 0, $length - 3) . '...';
    }
}
