<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Post\ImportPost;
use App\Models\CatModel;
use App\Models\SubjectModel;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;

class SubjectController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '题目列表';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new SubjectModel());

        $grid->tools(function (Grid\Tools $tools) {
            $tools->append(new ImportPost());
        });

        $grid->column('id', 'ID');
        $grid->column('title', '题目标题');
        $grid->column('cat_id', '专业分类')->using(CatModel::columnAll());
        $grid->column('created_at', '创建时间');
        $grid->column('updated_at', '更新时间');

        return $grid;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new SubjectModel());

        $form->text('title', '题目标题')->required();
        $form->select('cat_id', '分类')->options(CatModel::columnAll())->required();
        $form->table('content', '题目内容', function ($table) {
            $table->select('id', '选项标识')->options(SubjectModel::$optionLabel)->required();
            $table->text('option', '选项')->required();
        })->required();
        $form->select('true_option', '正确选项')->options(SubjectModel::$optionLabel)->required();

        return $form;
    }
}
