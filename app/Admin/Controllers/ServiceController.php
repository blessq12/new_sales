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

        $grid->filter(function ($filter) {
            $filter->like('name', __('Название'));
            $filter->like('price', __('Цена'));
        });

        $grid->model()->orderBy('id', 'desc');
        $grid->column('id', __('ID'));
        $grid->column('image', __('Изображение'))->image('', 100, 100);
        $grid->column('name', __('Название'));
        $grid->column('prefix', __('Префикс'));
        $grid->column('price', __('Цена'))->editable();
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
        $form->text('slug', __('Слаг'));
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
        $form->textarea('content', __('Контент'))->setElementClass('editor-mce form-control content');

        $form->hidden('created_at', __('Создано'));
        $form->hidden('updated_at', __('Обновлено'));

        $form->saving(function (Form $form) {
            // $form->slug = Str::slug($form->name);
            $form->description = Str::limit(
                strip_tags($form->content),
                160
            );
        });
        return $form;
    }
}
