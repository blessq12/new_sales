<?php

namespace App\Services;

use GuzzleHttp\Client;

class YandexMetrikaService
{
    protected $client;
    protected $token;

    public $todayVisits;
    public $todayPageviews;
    public $todayUsers;
    public $todayPercentNewVisitors;
    public $todayBounceRate;
    public $todayPageDepth;
    public $todayAvgVisitDurationSeconds;

    public function __construct()
    {
        $this->token = env('YANDEX_METRIKA_TOKEN');
        $this->client = new Client();
    }

    public function getMetrics()
    {
        $metrics = $this->getMetricsData();

        $this->todayVisits = $metrics['data'][0]['metrics'][0];
        $this->todayUsers = $metrics['data'][0]['metrics'][1];
        $this->todayPageviews = $metrics['data'][0]['metrics'][2];
        $this->todayPercentNewVisitors = round($metrics['data'][0]['metrics'][3], 2);
        $this->todayBounceRate = round($metrics['data'][0]['metrics'][4], 2);
        $this->todayPageDepth = round($metrics['data'][0]['metrics'][5], 2);
        $this->todayAvgVisitDurationSeconds = $this->getMetrikaTime($metrics['data'][0]['metrics'][6]);

        return $this;
    }

    private function getMetricsData()
    {
        $response = $this->client->request('GET', 'https://api-metrika.yandex.ru/stat/v1/data', [
            'headers' => [
                'Authorization' => 'OAuth ' . $this->token,
            ],
            'query' => [
                'id' => '49782487',
                'metrics' => '
                    ym:s:visits,
                    ym:s:users,
                    ym:s:pageviews,
                    ym:s:percentNewVisitors,
                    ym:s:bounceRate,
                    ym:s:pageDepth,
                    ym:s:avgVisitDurationSeconds',
                'date1' => 'today',
                'date2' => 'today',
            ],
        ]);

        return json_decode($response->getBody(), true);
    }

    private function getMetrikaTime($duration)
    {
        $minutes = floor($duration / 60);
        $seconds = $duration % 60;

        return sprintf("%d:%02d", $minutes, $seconds);
    }
}
