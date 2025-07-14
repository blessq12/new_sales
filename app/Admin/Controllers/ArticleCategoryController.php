<?php

namespace App\Admin\Controllers;

use App\Models\ArticleCategory;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ArticleCategoryController extends AdminController
{
    protected $title = 'Категории статей';

    protected function grid()
    {
        $grid = new Grid(new ArticleCategory());

        $grid->column('id', __('ID'))->sortable();
        $grid->column('name', 'Название');
        $grid->column('slug', 'URL');
        $grid->column('parent.name', 'Родительская категория');
        $grid->column('sort_order', 'Порядок сортировки')->sortable();
        $grid->column('is_active', 'Активна')->switch();
        $grid->column('created_at', 'Создано')->sortable();

        return $grid;
    }

    protected function form()
    {
        $form = new Form(new ArticleCategory());

        $form->text('name', 'Название')->required();
        $form->text('slug', 'URL')->required();
        $form->textarea('description', 'Описание');
        $form->select('parent_id', 'Родительская категория')
            ->options(ArticleCategory::where('id', '!=', $form->model()->id)
                ->pluck('name', 'id'))
            ->nullable();
        $form->number('sort_order', 'Порядок сортировки')->default(0);
        $form->switch('is_active', 'Активна')->default(1);

        return $form;
    }

    protected function detail($id)
    {
        $show = new Show(ArticleCategory::findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('name', 'Название');
        $show->field('slug', 'URL');
        $show->field('description', 'Описание');
        $show->field('parent.name', 'Родительская категория');
        $show->field('sort_order', 'Порядок сортировки');
        $show->field('is_active', 'Активна');
        $show->field('created_at', 'Создано');
        $show->field('updated_at', 'Обновлено');

        return $show;
    }
}
