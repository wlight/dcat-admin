<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Mileage;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class MileageController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Mileage(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('customer_id');
            $grid->column('total');
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
        return Show::make($id, new Mileage(), function (Show $show) {
            $show->field('id');
            $show->field('customer_id');
            $show->field('total');
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
        return Form::make(new Mileage(), function (Form $form) {
            $form->display('id');
            $form->text('customer_id');
            $form->text('total');
        
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
