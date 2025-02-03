<?php

namespace App\Admin\Controllers;

use App\Models\Review;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ReviewController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Отзывы';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Review());
        // $grid->disableActions();

        $grid->column('id', __('ID'))->sortable();
        $grid->column('is_approved', __('Одобрен'))->switch();
        $grid->column('rating', __('Рейтинг'))->display(function ($val) {
            $rating = '';
            for ($i = 0; $i < $val; $i++) {
                $rating .= '⭐';
            }
            return $rating;
        })->sortable();
        $grid->column('name', __('Имя'))->limit(10);
        $grid->column('service_id', __('Услуга'))->display(function ($val) {
            return \App\Models\Service::find($val)->name;
        });
        $grid->column('message', __('Сообщение'))->limit(100);
        $grid->column('created_at', __('Создано'))->display(function ($val) {
            return \Carbon\Carbon::parse($val)->format('d.m.Y H:i');
        });
        $grid->column('updated_at', __('Обновлено'))->display(function ($val) {
            return \Carbon\Carbon::parse($val)->format('d.m.Y H:i');
        });

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed   $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Review::findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('name', __('Имя'));
        $show->field('service_id', __('ID услуги'));
        $show->field('rating', __('Рейтинг'));
        $show->field('message', __('Сообщение'));
        $show->field('agree_to_process_personal_data', __('Согласие на обработку персональных данных'));
        $show->field('created_at', __('Создано'));
        $show->field('updated_at', __('Обновлено'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Review);

        $form->display('id', __('ID'));
        $form->switch('is_approved', __('Одобрен'));
        $form->text('name', __('Имя'))->required();
        $form->display('service_id', __('ID услуги'));
        $form->display('rating', __('Рейтинг'));
        $form->display('message', __('Сообщение'));
        $form->display('agree_to_process_personal_data', __('Согласие на обработку персональных данных'));
        return $form;
    }
}
