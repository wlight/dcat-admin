<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Movie;
use App\Models\User;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class MovieController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Movie(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('title');
            $grid->column('director')->display(function($userId) {
                return User::find($userId)->name;
            });
            $grid->column('describe');
            $grid->column('rate');
            $grid->column('released', '上映？')->display(function($released) {
                return $released ? '是' : '否';
            });

            $grid->column('release_at');
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();
        
            $grid->filter(function (Grid\Filter $filter) {
                $filter->between('created_at', 'Created Time')->datetime();
        
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
        return Show::make($id, new Movie(), function (Show $show) {
            $show->field('id');
            $show->field('title');
            $show->field('director');
            $show->field('describe');
            $show->field('rate');
            $show->field('released');
            $show->field('release_at');
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
        return Form::make(new Movie(), function (Form $form) {
            $form->display('id');
            $form->text('title');
            $form->text('director');
            $form->text('describe');
            $form->text('rate');
            $form->text('released');
            $form->text('release_at');
        
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
