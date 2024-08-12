<?php

namespace AdminExtConfig\Http\Controllers;

use AdminExtConfig\ConfigServiceProvider;
use AdminExtConfig\Models\ConfigGroup;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Http\Controllers\AdminController;

class AdminConfigGroupController extends AdminController
{

    protected function title()
    {
        return ConfigServiceProvider::trans('admin-config-group.title');
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new ConfigGroup(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('name')->tree(true, false);
            $grid->column('key');
            $grid->column('desc');
            $grid->column('is_open')->switch();
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new ConfigGroup(), function (Form $form) {
            $form->display('id');
            $form->select('pid')->options(function () {
                return ConfigGroup::selectOptions();
            })->saving(function ($v) {
                return (int) $v;
            });
            $form->text('name')->required();
            $form->text('key')->required();
            $form->text('desc')->required();
            $form->switch('is_open')->default(1);

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
