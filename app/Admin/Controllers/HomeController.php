<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Layout\Content;


class HomeController extends Controller
{
    public function index(Content $content)
    {
        $services = \App\Models\Service::all();
        $orders = \App\Models\Order::all();
        $users = \App\Models\User::all();
        $reviews = \App\Models\Review::all();
        $metrics = (new \App\Services\Yandex\YandexMetrikaService())->getMetrics('sales');
        $categories = \App\Models\ServiceCategory::all();

        return $content
            ->title('Сводка')
            ->row(view('admin.home', compact('services', 'orders', 'users', 'reviews', 'metrics', 'categories'))->render());
    }
}
