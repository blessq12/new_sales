<?php

namespace App\Admin\Controllers;

use App\Models\Company;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class CompanyController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Компании';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Company);

        $grid->column('id', __('ID'))->sortable();
        $grid->column('logo', __('Логотип'))->image();
        $grid->column('name', __('Название'))->sortable();
        $grid->column('description', __('Описание'))->limit(30);

        $grid->column('phones', __('Телефоны'))->display(function ($value) {
            return collect($value)->map(function ($phone) {
                return "<b>Телефон</b>: {$phone}";
            })->implode('<br>');
        });

        // $grid->column('emails', __('Электронные почты'))->display(function ($value) {
        //     return collect($value)->map(function ($email) {
        //         return "<b>Email</b>: {$email}";
        //     })->implode('<br>');
        // });
        $grid->column('website', __('Вебсайт'));
        $grid->column('addresses', __('Адреса'))->display(function ($value) {
            return collect($value)->map(function ($address) {
                return "<b>Адрес</b>: {$address}";
            })->implode('<br>');
        });
        // $grid->column('serviceAreas', __('Сервисные зоны'))->display(function ($value) {
        //     return collect($value)->map(function ($area) {
        //         return "<b>Сервисная зона</b>: {$area}";
        //     })->implode('<br>');
        // });
        // $grid->column('suburbs', __('Пригороды'))->display(function ($value) {
        //     return collect($value)->map(function ($suburb) {
        //         return "<b>Пригород</b>: {$suburb}";
        //     })->implode('<br>');
        // });

        // $grid->column('created_at', __('Created at'))->display(function ($value) {
        //     return \Carbon\Carbon::parse($value)->format('d.m.Y H:i');
        // });
        // $grid->column('updated_at', __('Updated at'))->display(function ($value) {
        //     return \Carbon\Carbon::parse($value)->format('d.m.Y H:i');
        // });

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
        $show = new Show(Company::findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('logo', __('Логотип'))->image();
        $show->field('name', __('Название'));
        $show->field('description', __('Описание'));
        $show->field('website', __('Вебсайт'));
        $show->field('phones', __('Телефоны'))->as(function ($value) {
            return json_encode($value, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        })->unescape()->copyable();
        $show->field('addresses', __('Адреса'))->as(function ($value) {
            return json_encode($value, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        })->unescape()->copyable();
        $show->field('serviceAreas', __('Сервисные зоны'))->as(function ($value) {
            return json_encode($value, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        })->unescape()->copyable();
        $show->field('suburbs', __('Пригороды'))->as(function ($value) {
            return json_encode($value, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        })->unescape()->copyable();
        $show->field('socials', __('Социальные сети'))->as(function ($value) {
            return json_encode($value, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        })->unescape()->copyable();
        $show->field('created_at', __('Created at'))->as(function ($value) {
            return \Carbon\Carbon::parse($value)->format('d.m.Y H:i');
        });
        $show->field('updated_at', __('Updated at'))->as(function ($value) {
            return \Carbon\Carbon::parse($value)->format('d.m.Y H:i');
        });

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Company);

        $form->display('id', __('ID'));
        $form->text('name', __('Название'))->required();
        $form->text('description', __('Описание'));
        $form->text('website', __('Вебсайт'));
        $form->list('phones', __('Телефоны'));
        $form->list('emails', __('Электронные почты'));
        $form->list('addresses', __('Адреса'));
        $form->list('serviceAreas', __('Сервисные зоны'));
        $form->list('suburbs', __('Пригороды'));
        $form->table('socials', __('Социальные сети'), function ($table) {
            $table->text('title', __('Название'));
            $table->text('url', __('URL'));
            $table->text('icon', __('Иконка'));
        });
        $form->display('created_at', __('Created At'));
        $form->display('updated_at', __('Updated At'));

        return $form;
    }
}
