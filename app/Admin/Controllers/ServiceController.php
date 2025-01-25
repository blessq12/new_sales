<?php

namespace App\Admin\Controllers;

use App\Models\Service;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ServiceController extends AdminController
{
    protected function grid()
    {
        $grid = new Grid(new Service);
        $grid->column('id', __('ID'));
        $grid->column('name', __('Название'));
        $grid->column('description', __('Описание'))->limit(30);
        // $grid->column('content', __('Описание'))->limit(30);
        $grid->column('image', __('Изображение'))->image();
        $grid->column('price', __('Цена'));
        // $grid->column('prefix', __('Префикс'));
        $grid->column('slug', __('Слаг'));

        $grid->column('created_at', __('Создано'))->as(function ($value) {
            return \Carbon\Carbon::parse($value)->format('d.m.Y H:i');
        });
        $grid->column('updated_at', __('Обновлено'))->as(function ($value) {
            return \Carbon\Carbon::parse($value)->format('d.m.Y H:i');
        });
        return $grid;
    }

    protected function detail($id)
    {
        $show = new Show(Service::findOrFail($id));
        $show->field('id', __('ID'));
        $show->field('name', __('Название'));
        $show->field('description', __('Описание'));
        $show->field('image', __('Изображение'))->image();
        $show->field('price', __('Цена'));
        $show->field('slug', __('Слаг'));
        $show->field('created_at', __('Создано'));
        $show->field('updated_at', __('Обновлено'));
        return $show;
    }

    protected function form()
    {
        $form = new Form(new Service);
        $form->text('slug', __('Слаг'))->required();
        $form->text('name', __('Название'))->required();
        $form->textarea('description', __('Описание'))->required();
        $form->image('image', __('Изображение'))->required();
        $form->text('prefix', __('Префикс'));
        $form->text('price', __('Цена'))->required();
        $form->textarea('content', __('Контент страницы'), ['class' => 'content-editor']);
        return $form;
    }
}
