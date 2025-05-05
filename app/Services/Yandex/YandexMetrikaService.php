<?php

namespace App\Services\Yandex;

class YandexMetrikaService extends YandexService
{
    protected $url = 'https://api-metrika.yandex.net';
    public $counters = [
        'sales' => 49782487,
    ];

    public function __construct()
    {
        parent::__construct();
    }
    public function getCounters()
    {
        $response = $this->client->request('GET', $this->url . '/management/v1/counters');
        return json_decode($response->getBody(), true);
    }

    public function getMetrics(string $counter)
    {
        if (!isset($this->counters[$counter])) {
            throw new \Exception('Counter not found');
        }

        try {
            $response = $this->client->request('GET', $this->url . '/stat/v1/data', [
                'query' => [
                    'ids' => $this->counters[$counter],
                    'metrics' => 'ym:s:pageviews,ym:s:visits,ym:s:users,ym:s:avgVisitDurationSeconds,ym:s:pageDepth,ym:s:bounceRate',
                    'dimensions' => 'ym:s:date,ym:s:trafficSource',
                    'date1' => now()->format('Y-m-d'),
                    'date2' => now()->format('Y-m-d'),
                    'group' => 'day',
                ]
            ]);

            $data = json_decode($response->getBody()->getContents(), true);

            if (empty($data['data'])) {
                return (object) ['error' => 'No data for today'];
            }

            $metrics = [
                'date' => $data['data'][0]['dimensions'][0]['name'],
                'pageviews' => 0,
                'visits' => 0,
                'users' => 0,
                'avg_time_on_site' => 0,
                'page_depth' => 0,
                'bounce_rate' => 0,
                'sources' => [
                    'direct' => 0,
                    'search' => 0,
                    'social' => 0,
                ],
            ];

            foreach ($data['data'] as $row) {
                $source = $row['dimensions'][1]['name'] ?? 'unknown';
                $metrics['pageviews'] += $row['metrics'][0];
                $metrics['visits'] += $row['metrics'][1];
                $metrics['users'] += $row['metrics'][2];
                $metrics['avg_time_on_site'] += $row['metrics'][3];
                $metrics['page_depth'] += $row['metrics'][4];
                $metrics['bounce_rate'] += $row['metrics'][5];

                if ($source === 'direct') {
                    $metrics['sources']['direct'] += $row['metrics'][1];
                } elseif ($source === 'search') {
                    $metrics['sources']['search'] += $row['metrics'][1];
                } elseif ($source === 'social') {
                    $metrics['sources']['social'] += $row['metrics'][1];
                }
            }

            $count = count($data['data']);
            $metrics['avg_time_on_site'] = $count > 0 ? round($metrics['avg_time_on_site'] / $count / 60, 2) : 0; // Секунды в минуты
            $metrics['page_depth'] = $count > 0 ? round($metrics['page_depth'] / $count, 2) : 0;
            $metrics['bounce_rate'] = $count > 0 ? round($metrics['bounce_rate'] / $count, 2) : 0;

            return (object) $metrics;
        } catch (\Exception $e) {
            \Log::error('Ошибка при получении данных из Яндекс.Метрики: ' . $e->getMessage());
            return (object) ['error' => 'Failed to fetch data'];
        }
    }
}
