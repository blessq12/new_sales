<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('companies', CompanyController::class);
    $router->resource('company-legals', CompanyLegalController::class);
    $router->resource('services', ServiceController::class);
    $router->resource('user-requests', UserRequestController::class);
    $router->resource('reviews', ReviewController::class);
    $router->resource('galleries', GalleryController::class);
    $router->resource('service-categories', ServiceCategoryController::class);
    $router->resource('qr-codes', QrCodeController::class);
    $router->resource('article-categories', ArticleCategoryController::class);
    $router->resource('articles', ArticleController::class);
});
