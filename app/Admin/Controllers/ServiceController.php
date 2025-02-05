<?php

namespace App\Admin\Controllers;

use App\Models\Service;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Str;

class ServiceController extends AdminController
{
    protected function grid()
    {
        $grid = new Grid(new Service);
        $grid->model()->orderBy('id', 'desc');
        $grid->column('id', __('ID'));
        $grid->column('image', __('Изображение'))->image('', 100, 100);
        $grid->column('name', __('Название'));
        $grid->column('description', __('Описание'))->limit(30);
        $grid->column('price', __('Цена'))->display(function ($value) {
            return $this->prefix . ' ' . $value;
        });
        $grid->column('slug', __('Слаг'));

        $grid->column('created_at', __('Создано'))->display(function ($value) {
            return \Carbon\Carbon::parse($value)->format('d.m.Y H:i');
        });
        $grid->column('updated_at', __('Обновлено'))->display(function ($value) {
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
        $form->display('slug', __('Слаг'));
        $form->text('name', __('Название'))->required();
        $form->hidden('description', __('Описание'));
        $form->image('image', __('Изображение'))
            ->uniqueName()
            ->move('services')
            ->resize(1024, null, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->encode('webp', 80)
            ->required();
        $form->text('prefix', __('Префикс'));
        $form->text('price', __('Цена'))->required();
        $form->textarea('content', __('Контент страницы'))->addElementClass('content-editor');

        $form->display('created_at', __('Создано'));
        $form->display('updated_at', __('Обновлено'));

        $form->saving(function (Form $form) {
            $form->slug = Str::slug($form->name);
            $form->description = Str::limit(
                strip_tags($form->content),
                160
            );
        });
        return $form;
    }
}
