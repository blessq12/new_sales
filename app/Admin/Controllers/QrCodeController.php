<?php

namespace App\Admin\Controllers;

use App\Services\QrCodeService;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\QrCode;
use Illuminate\Support\Facades\Storage;

class QrCodeController extends AdminController
{
    protected $title = 'QR Code';
    protected $qrCodeService;

    public function __construct(QrCodeService $qrCodeService)
    {
        $this->qrCodeService = $qrCodeService;
    }

    protected function grid()
    {
        $grid = new Grid(new QrCode());
        $grid->column('id', __('ID'))->sortable();
        $grid->column('image', __('Изображение'))->display(function ($image) {
            return $image ? asset($image) : '';
        })->image('', 100, 100);
        $grid->column('qr_link', __('Ссылка'))->link();
        $grid->column('status', __('Статус'))->switch();
        $grid->column('created_at', __('Дата создания'))->display(fn($value) => \Carbon\Carbon::parse($value)->format('d.m.Y H:i'));
        $grid->column('updated_at', __('Дата обновления'))->display(fn($value) => \Carbon\Carbon::parse($value)->format('d.m.Y H:i'));
        return $grid;
    }

    protected function detail($id)
    {
        $show = new Show(QrCode::findOrFail($id));
        $show->field('id', __('ID'));
        $show->field('image', __('Изображение'))->as(function ($image) {
            return $image ? asset($image) : '';
        })->image();
        $show->field('qr_link', __('Ссылка'))->link();
        $show->field('status', __('Статус'))->switch();
        return $show;
    }

    protected function form()
    {
        $form = new Form(new QrCode());
        $form->text('qr_link', __('Ссылка'))->rules('required');
        $form->switch('status', __('Статус'))->default(true);

        $form->saved(function (Form $form) {
            if (!$form->model()->image) {
                $redirectUrl = url("/api/get-link/{$form->model()->id}");
                $imagePath = $this->qrCodeService->generateQrCode($redirectUrl);
                $form->model()->app_link = $redirectUrl;
                $form->model()->image = $imagePath;
                $form->model()->save();
            }
        });

        $form->editing(function (Form $form) {
            $form->display('image', __('Изображение'))->with(function ($value) {
                return $value ? "<img src='" . asset($value) . "' style='max-width:200px;'/>" : '';
            });
        });

        return $form;
    }
}
