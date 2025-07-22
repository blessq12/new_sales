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
        $grid->column('is_active', 'Активна')->switch([
            0 => 'danger',
            1 => 'success'
        ]);
        $grid->column('published', 'Опубликовано')
            ->display(function ($value) {
                return $value ? 'Да' : 'Нет';
            })
            ->label([
                0 => 'danger',
                1 => 'success'
            ]);

        $grid->column('is_scheduled', 'Тип публикации')->display(function ($value) {
            return $value ? 'Запланированная' : 'Обычная';
        })->label([
            0 => 'success',
            1 => 'info'
        ]);
        $grid->column('title', 'Заголовок');
        $grid->column('category.name', 'Категория');
        $grid->column('suggested_services_ids', 'Связанные услуги')
            ->display(function ($ids) {
                if (!$ids) return '';
                $services = \App\Models\Service::whereIn('id', $ids)->pluck('name')->toArray();
                return implode(', ', $services);
            });
        $grid->column('scheduled_at', 'Запланирована на')
            ->display(fn($value) => $value ? \Carbon\Carbon::parse($value)->setTimezone('Asia/Tomsk')->format('d.m.Y H:i') : null)
            ->sortable();
        $grid->column('created_at', 'Создано')->sortable()
            ->display(fn($value) => \Carbon\Carbon::parse($value)->setTimezone('Asia/Tomsk')->format('d.m.Y H:i'));

        $grid->filter(function ($filter) {
            $filter->like('title', 'Заголовок');
            $filter->equal('category_id', 'Категория')->select(ArticleCategory::pluck('name', 'id'));
            $filter->equal('is_active', 'Активна')->select([0 => 'Нет', 1 => 'Да']);
            $filter->between('scheduled_at', 'Запланирована на')->datetime();
        });

        return $grid;
    }

    protected function form()
    {
        $form = new Form(new Article());
        $form->select('category_id', 'Категория')
            ->options(ArticleCategory::pluck('name', 'id'))
            ->required();

        $form->radioButton('is_scheduled', 'Тип публикации')
            ->options([
                0 => 'Обычная публикация',
                1 => 'Запланированная публикация',
            ])
            ->when(1, function ($form) {
                $form->datetime('scheduled_at', 'Запланировать публикацию на')
                    ->help('Статья будет автоматически опубликована в указанное время');
            })
            ->default(0);

        $form->text('slug', 'URL')->readonly()->help('URL будет автоматически генерироваться из названия');
        $form->text('title', 'Заголовок')->required();

        $form->image('cover_image', 'Обложка')
            ->uniqueName()
            ->move('articles/covers')
            ->resize(1024, null, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->encode('webp', 80)
            ->required();
        $form->textarea('short_description', 'Краткое описание')->required();
        $form->textarea('content', __('Контент'))->setElementClass('editor-mce form-control content');

        $form->multipleSelect('suggested_services_ids', 'Связанные услуги')
            ->options(\App\Models\Service::pluck('name', 'id'))
            ->help('Выберите услуги, которые будут рекомендованы в статье');

        $form->switch('is_active', 'Активна')->default(1);

        $form->saving(function (Form $form) {
            if (!$form->slug) {
                $form->slug = \Illuminate\Support\Str::slug($form->title);
            }
        });

        $form->saved(function (Form $form) {
            $model = $form->model();

            // Для новой или обычной публикации
            if (!$model->is_scheduled) {
                $model->scheduled_at = null;
                $model->published_at = now()->setTimezone('Asia/Tomsk');
                $model->save();
            }

            // Для отложенной публикации с наступившей датой
            if ($model->is_scheduled && $model->scheduled_at && $model->scheduled_at <= now()) {
                $model->is_active = true;
                $model->published_at = now()->setTimezone('Asia/Tomsk');
                $model->scheduled_at = null;
                $model->is_scheduled = false;
                $model->save();
            }

            // Если статья стала неактивной
            if (!$model->is_active && $model->getOriginal('is_active')) {
                $model->published_at = null;
                $model->save();
            }
        });

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
