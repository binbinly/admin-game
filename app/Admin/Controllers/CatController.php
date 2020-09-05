<?php

namespace App\Admin\Controllers;

use App\Models\CatModel;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;

class CatController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '专业分类';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new CatModel());
        $grid->disableExport();

        $grid->column('id', 'ID');
        $grid->column('name', '专业名');
        $grid->column('sort', '排序')->editable();

        return $grid;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new CatModel());

        $form->text('name', '专业名')->required();
        $form->number('sort', '排序')->default(0);

        return $form;
    }
}
