<?php

namespace App\Admin\Controllers;

use App\Models\Article;
use App\Models\ArticleCategory;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ArticleController extends AdminController
{
    protected $title = 'Статьи';

    protected function grid()
    {
        $grid = new Grid(new Article());

        $grid->column('id', __('ID'))->sortable();
        $grid->column('title', 'Заголовок');
        $grid->column('slug', 'URL');
        $grid->column('category.name', 'Категория');
        $grid->column('views_count', 'Просмотры')->sortable();
        $grid->column('is_active', 'Активна')->switch();
        $grid->column('published_at', 'Опубликовано')->sortable();
        $grid->column('created_at', 'Создано')->sortable();

        $grid->filter(function ($filter) {
            $filter->like('title', 'Заголовок');
            $filter->equal('category_id', 'Категория')->select(ArticleCategory::pluck('name', 'id'));
            $filter->equal('is_active', 'Активна')->select([0 => 'Нет', 1 => 'Да']);
        });

        return $grid;
    }

    protected function form()
    {
        $form = new Form(new Article());

        $form->text('title', 'Заголовок')->required();
        $form->text('slug', 'URL')->required();
        $form->image('cover_image', 'Обложка')->move('articles/covers');
        $form->textarea('short_description', 'Краткое описание')->required();
        $form->textarea('content', 'Содержание')->required();
        $form->select('category_id', 'Категория')
            ->options(ArticleCategory::pluck('name', 'id'))
            ->required();
        $form->switch('is_active', 'Активна')->default(1);
        $form->datetime('published_at', 'Дата публикации')->default(date('Y-m-d H:i:s'));

        return $form;
    }

    protected function detail($id)
    {
        $show = new Show(Article::findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('title', 'Заголовок');
        $show->field('slug', 'URL');
        $show->field('cover_image', 'Обложка')->image();
        $show->field('short_description', 'Краткое описание');
        $show->field('content', 'Содержание');
        $show->field('category.name', 'Категория');
        $show->field('views_count', 'Просмотры');
        $show->field('is_active', 'Активна');
        $show->field('published_at', 'Опубликовано');
        $show->field('created_at', 'Создано');
        $show->field('updated_at', 'Обновлено');

        return $show;
    }
}
