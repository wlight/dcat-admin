<?php

namespace App\Admin\Widgets;

use App\Admin\Repositories\MileageRecord;
use Dcat\Admin\Grid;
use Illuminate\Contracts\Support\Renderable;

class MileageRecordRender implements Renderable
{
    protected int $customerId;

    public function __construct($customerId)
    {
        $this->customerId = $customerId;
    }

    public function render()
    {
        $grid = Grid::make(new MileageRecord());
        $grid->setName('mileage');

        $grid->model()->where('customer_id', $this->customerId);
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
