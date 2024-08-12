<?php

namespace AdminExtConfig\Http\Controllers;

use AdminExtConfig\ConfigServiceProvider;
use AdminExtConfig\Models\Config;
use AdminExtConfig\Models\ConfigGroup;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Http\Controllers\AdminController;

class AdminConfigController extends AdminController
{

    protected function title()
    {
        return ConfigServiceProvider::trans('admin-config.title');
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Config(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('group_id')->using(ConfigGroup::selectOptions());
            $grid->column('name');
            $grid->column('key')->label();
            $grid->column('type');
            $grid->column('rules');
            $grid->column('desc');
            $grid->column('sort');
            $grid->column('is_open')->bool();
            $grid->column('is_required')->bool();
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');

            });
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Config(), function (Form $form) {
            $form->display('id');
            $form->select('group_id')->options(function () {
                return ConfigGroup::selectOptions();
            })->saving(function ($v) {
                return (int) $v;
            })->required();
            $form->text('name')->required();
            $form->text('key')->required();
            $form->select('type')->options(Config::$fieldTypes)->required();
            $form->text('rules')->help('参考规则写法:https://learnku.com/docs/dcat-admin/2.x/form-validation/8112');
            $form->text('desc')->required();
            $form->number('sort')->default(0);
            $form->switch('is_required');
            $form->switch('is_open')->default(1);

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
