<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Point;
use App\Models\Point as PointModel;
use App\Admin\Repositories\PointRecord;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Widgets\Tab;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Model;


class PointController extends AdminController
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
        $grid = Grid::make(new PointRecord());
        $point = PointModel::find($id);
        if (!$point) {
            return;
        }
        $customer_id = $point->customer_id;

        $grid->model()->where('customer_id', $customer_id);
        $grid->column('id')->sortable();
        $grid->column('description');
        $grid->column('amount_changed')->display(function ($amountChanged) {
            if ($amountChanged < 0) {
                return "<span style='color:red'>$amountChanged</span>";
            } else {
                return "<span style='color:green'>$amountChanged</span>";
            }
        });
        $grid->column('operated_total');
        $grid->column('order_id');
        $grid->column('created_at');
        $grid->column('updated_at')->sortable();

        // 设置样式
        $grid->disableCreateButton();
        $grid->disableRowSelector();
        $grid->disableEditButton();
        $grid->disableDeleteButton();
        $grid->disableActions();
        $grid->filter(function (Grid\Filter $filter) {
            $filter->equal('id');
        });

        // 设置脚部
        $grid->footer(function ($collection) use ($point) {


//               $query = Model::query();
//
//               // 拿到表格筛选 where 条件数组进行遍历
//                $grid->model()->getQueries()->unique()->each(function ($value) use (&$query) {
//                    if (in_array($value['method'], ['paginate', 'get', 'orderBy', 'orderByDesc'], true)) {
//                        return;
//                    }
//
//                    $query = call_user_func_array([$query, $value['method']], $value['arguments'] ?? []);
//                });
//
//                // 查出统计数据
//                $data = $grid->model()->getQueries()->query->get();

            return "<div style='padding: 10px;'>总收入 ： " . $point->total . "</div>";
        });
        return $grid;


//        return Show::make($id, new Point(), function (Show $show) {?


//            $show->field('id');
//            $show->field('customer_id');
//            $show->field('total');
////            $show->field('created_at');
//            $show->field('updated_at');
//            $show->disableEditButton();
//            $show->disableDeleteButton();
//
//            // 添加记录表单
//            $show->relation('record', function($model) {
//
//            });
//        });
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
