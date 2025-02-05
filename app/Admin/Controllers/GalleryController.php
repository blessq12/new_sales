<?php

namespace App\Admin\Controllers;

use App\Models\Gallery;
use App\Models\GalleryImage;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class GalleryController extends AdminController
{
    protected $title = 'Галереи';

    protected function grid()
    {
        $grid = new Grid(new Gallery());

        $grid->column('id', 'ID')->sortable();
        $grid->column('title', 'Название');
        $grid->column('is_active', 'Активна')->switch();
        $grid->column('created_at', 'Создано');
        $grid->column('updated_at', 'Обновлено');

        return $grid;
    }

    protected function detail($id)
    {
        $show = new Show(Gallery::findOrFail($id));

        $show->field('id', 'ID');
        $show->field('title', 'Название');
        $show->field('is_active', 'Активна');
        $show->field('created_at', 'Создано');
        $show->field('updated_at', 'Обновлено');

        return $show;
    }

    protected function form()
    {
        $form = new Form(new Gallery());
        $form->text('title', 'Название')->rules('required');
        $form->text('description', 'Описание')->rules('required');
        $form->switch('is_active', 'Активна')->default(true);
        $form->multipleImage('images', 'Изображения')
            ->uniqueName()
            ->pathColumn('image_path')
            ->move('galleries')
            ->removable();
        return $form;
    }
}
