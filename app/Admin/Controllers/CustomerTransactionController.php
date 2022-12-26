<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Point;
use App\Admin\Widgets\MileageRecordRender;
use App\Admin\Widgets\PointRecordRender;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Widgets\Tab;
use Illuminate\Contracts\Support\Renderable;

class CustomerTransactionController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid($id = 0)
    {
        $grid = Grid::make(new Point());
        $grid->column('id')->sortable();
        $grid->column('customer_id');
        $grid->column('total');
        $grid->column('created_at');
        $grid->column('updated_at')->sortable();

        // 设置样式
        $grid->setActionClass(Grid\Displayers\Actions::class);

        $grid->disableCreateButton();
        $grid->disableRowSelector();
        $grid->disableEditButton();
        $grid->disableDeleteButton();

        $grid->filter(function (Grid\Filter $filter) {
            $filter->equal('id');

        });

        // 更改表格外层容器
        $grid->wrap(function (Renderable $view) {
            $tab = Tab::make();

            $tab->add('Point', $view);
            $tab->add('Mileage', $view);

            return $tab;
        });

        return $grid;
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
        $tab = Tab::make();

        $tab->add('Point', new PointRecordRender($id));
        $tab->add('Mileage', new MileageRecordRender($id));

        return $tab;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Point(), function (Form $form) {
            $form->display('id');
            $form->text('customer_id');
            $form->text('total');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
