<?php

namespace App\Admin\Controllers;

use App\Models\ServiceCategory;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ServiceCategoryController extends AdminController
{
    protected $title = 'Категории услуг';

    protected function grid()
    {
        $grid = new Grid(new ServiceCategory());
        $grid->column('id', __('ID'))->sortable();
        $grid->column('order', __('Порядок'))->editable()->sortable();
        $grid->column('status', __('Статус'))->switch();
        $grid->column('image', __('Изображение'))->image('', 100, 100);
        $grid->column('name', __('Название'));
        $grid->column('slug', __('Ссылка'));
        $grid->column('updated_at', __('Обновлено'))->display(function ($value) {
            return \Carbon\Carbon::parse($value)->format('d.m.Y H:i');
        });
        return $grid;
    }


    protected function detail($id)
    {
        $show = new Show(ServiceCategory::findOrFail($id));
        $show->field('id', __('ID'));
        $show->field('name', __('Название'));
        $show->field('slug', __('Ссылка'));
        $show->field('status', __('Статус'));
        $show->field('order', __('Порядок'));
        return $show;
    }
    protected function form()
    {
        $form = new Form(new ServiceCategory());
        $form->display('slug', __('Ссылка'));
        $form->text('name', __('Название'));
        $form->textarea('description', __('Описание'));
        $form->image('image', __('Изображение'))
            ->uniqueName()
            ->move('service_categories')
            ->fit(1920, 1080);
        $form->select('status', __('Статус'))->options([
            '1' => 'Активный',
            '0' => 'Неактивный',
        ])->default('1');
        $form->text('order', __('Порядок'))->default(function ($form) {
            return ServiceCategory::max('order') + 1;
        });

        $form->saved(function ($form) {
            if (empty($form->model()->slug)) {
                $form->model()->slug = \Illuminate\Support\Str::slug($form->name);
            }
            $form->model()->save();
        });
        return $form;
    }
}
