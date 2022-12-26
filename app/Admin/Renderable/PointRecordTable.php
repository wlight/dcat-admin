<?php

namespace App\Admin\Renderable;

use App\Admin\Repositories\PointRecord;
use Dcat\Admin\Grid;

class PointRecordTable extends Grid\LazyRenderable
{

    public function grid(): Grid
    {
        $grid = Grid::make(new PointRecord());
        $grid->setName('point');

        $grid->model()->where('customer_id', $this->payload);
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

        return $grid;
    }
}
