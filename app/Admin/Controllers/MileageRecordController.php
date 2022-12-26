<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\MileageRecord;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class MileageRecordController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new MileageRecord(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('customer_id');
            $grid->column('description');
            $grid->column('amount_changed');
            $grid->column('operated_total');
            $grid->column('admin_id');
            $grid->column('order_id');
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();
        
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
        
            });
        });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        return Show::make($id, new MileageRecord(), function (Show $show) {
            $show->field('id');
            $show->field('customer_id');
            $show->field('description');
            $show->field('amount_changed');
            $show->field('operated_total');
            $show->field('admin_id');
            $show->field('order_id');
            $show->field('created_at');
            $show->field('updated_at');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new MileageRecord(), function (Form $form) {
            $form->display('id');
            $form->text('customer_id');
            $form->text('description');
            $form->text('amount_changed');
            $form->text('operated_total');
            $form->text('admin_id');
            $form->text('order_id');
        
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
