<?php

namespace App\Admin\Controllers;

use App\Models\SearchConfigModel;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;

class SearchConfigController extends AdminController
{

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new SearchConfigModel());
        $grid->disableExport();

        $grid->column('id', '第几关');
        $grid->column('title', '标题');

        return $grid;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new SearchConfigModel());

        $form->number('id', '第几关')->required();
        $form->text('title', '标题')->required();
        $form->textarea('value', '配置信息')->required();

        return $form;
    }
}
