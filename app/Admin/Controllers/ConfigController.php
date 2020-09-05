<?php

namespace App\Admin\Controllers;

use App\Models\ConfigModel;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ConfigController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '配置列表';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ConfigModel());
        $grid->disableExport();

        $grid->column('name', '配置名');
        $grid->column('value', '配置值');
        $grid->column('desc', '配置描述');

        return $grid;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new ConfigModel());

        $form->text('name', '配置名')->required();
        $form->textarea('value', '配置值')->required();
        $form->textarea('desc', '配置描述');

        return $form;
    }
}
