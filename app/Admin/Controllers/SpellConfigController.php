<?php

namespace App\Admin\Controllers;

use App\Models\ConfigModel;
use App\Models\SearchConfigModel;
use App\Models\SpellConfigModel;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;

class SpellConfigController extends AdminController
{

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new SpellConfigModel());
        $grid->disableExport();

        $grid->column('id', '第几关');
        $grid->column('title', '标题');
        $grid->column('image', '封面')->image();

        return $grid;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new SpellConfigModel());

        $form->number('id', '第几关')->required();
        $form->text('title', '标题')->required();
        $form->image('image', '图片')->required();
        $form->textarea('value', '配置信息')->required();

        return $form;
    }
}
