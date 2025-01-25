<?php

namespace App\Admin\Controllers;

use App\Models\CompanyLegal;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class CompanyLegalController extends AdminController
{
    protected function title()
    {
        return 'Юридические лица';
    }

    protected function grid()
    {
        $grid = new Grid(new CompanyLegal);

        $grid->column('id', __('ID'))->sortable();
        $grid->column('company_id', __('ID компании'))->display(function ($value) {
            return \App\Models\Company::find($value)->name;
        });
        $grid->column('name', __('Название'))->limit(30);
        $grid->column('account_number', __('Номер счета'));
        // $grid->column('currency', __('Валюта'));
        $grid->column('inn', __('ИНН'));
        $grid->column('kpp', __('КПП'));
        // $grid->column('bank', __('Банк'));
        $grid->column('bik', __('БИК'));
        $grid->column('correspondent_account', __('Корреспондентский счет'));
        // $grid->column('legal_address', __('Юридический адрес'));

        $grid->column('created_at', __('Created at'))->display(function ($value) {
            return \Carbon\Carbon::parse($value)->format('d.m.Y H:i');
        });
        $grid->column('updated_at', __('Updated at'))->display(function ($value) {
            return \Carbon\Carbon::parse($value)->format('d.m.Y H:i');
        });
        return $grid;
    }

    protected function detail($id)
    {
        $show = new Show(CompanyLegal::findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('company_id', __('ID компании'))->as(function ($value) {
            return \App\Models\Company::find($value)->name;
        });
        $show->field('name', __('Название'));
        $show->field('account_number', __('Номер счета'));
        $show->field('currency', __('Валюта'));
        $show->field('inn', __('ИНН'));
        $show->field('kpp', __('КПП'));
        $show->field('bank', __('Банк'));
        $show->field('bik', __('БИК'));
        $show->field('correspondent_account', __('Корреспондентский счет'));
        $show->field('legal_address', __('Юридический адрес'));
        $show->field('created_at', __('Создано'))->as(function ($value) {
            return \Carbon\Carbon::parse($value)->format('d.m.Y H:i');
        });
        $show->field('updated_at', __('Обновлено'))->as(function ($value) {
            return \Carbon\Carbon::parse($value)->format('d.m.Y H:i');
        });

        return $show;
    }

    protected function form()
    {
        $form = new Form(new CompanyLegal);

        $form->select('company_id', __('ID компании'))->options(\App\Models\Company::all()->pluck('name', 'id'));
        $form->text('name', __('Название'))->required();
        $form->text('account_number', __('Номер счета'))->required();
        $form->text('currency', __('Валюта'))->required();
        $form->text('inn', __('ИНН'))->required();
        $form->text('kpp', __('КПП'))->required();
        $form->text('bank', __('Банк'))->required();
        $form->text('bik', __('БИК'))->required();
        $form->text('correspondent_account', __('Корреспондентский счет'))->required();
        $form->text('legal_address', __('Юридический адрес'))->required();

        return $form;
    }
}
