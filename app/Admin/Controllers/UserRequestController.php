<?php

namespace App\Admin\Controllers;

use App\Models\UserRequest;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Widgets\Table;

class UserRequestController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Запросы пользователей';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new UserRequest);
        $grid->model()->orderBy('id', 'desc');

        $grid->column('id', __('ID'))->sortable();
        $grid->column('type', __('Тип запроса'))->display(function ($val) {
            return '<b>' . UserRequest::$types[$val] . '</b>';
        })->color('success');
        $grid->column('client_id', __('ID клиента'))->display(function ($val) {
            return $val ? \App\Models\User::find($val)->name : 'нет';
        });
        $grid->column('data', __('Данные'))
            ->display(function ($val) {
                return 'Смотреть ';
            })
            ->modal('Данные о заявке', function ($model) {
                $data = collect($model->data);
                return view('admin.user_request_data', ['data' => $data]);
            });
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
        $show = new Show(UserRequest::findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('client_id', __('ID клиента'));
        $show->field('type', __('Тип запроса'));
        $show->field('data', __('Данные'));
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
        $form = new Form(new UserRequest);

        $form->display('id', __('ID'));
        $form->number('client_id', __('ID клиента'))->required();
        $form->select('type', __('Тип запроса'))->options(UserRequest::$types)->required();
        $form->textarea('data', __('Данные'));

        return $form;
    }
}
