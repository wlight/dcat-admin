<?php

namespace App\Http\Controllers;

use App\Models\CustomerTransaction;
use App\Models\Mileage;
use App\Models\MileageRecord;
use App\Models\Point;
use App\Models\PointRecord;
use App\Models\StoreCredit;
use App\Models\StoreCreditRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function handle(){

        // 取出所有的数据，trunk取出
        // 如果amount 有值，这存入store_credit_record表，字段：customer_id
        // 如果integral 有值，存入 point_record表
        // 如果mileage 有值，存入 point_record表

        CustomerTransaction::query()->orderBy('customer_transaction_id')
            ->chunkById(100, function ($items) {
                foreach ($items as $item) {
                    if ($item->integral) {
                        $this->insertToPoint($item);
                    }
                    if (bccomp($item->mileage, 0.00, 2)) {
                        $this->insertToMileage($item);
                    }
                    if (bccomp($item->amount, 0.00, 2)) {
                        $this->insertToStoreCredit($item);
                    }

                }

            });

        return 'success';
    }

    public function insertToPoint($item){
        DB::transaction(function () use ($item) {
            // 总记录
            $point = Point::query()->firstOrCreate(
                    ['customer_id' => $item->customer_id],
                    ['total' => 0, 'created_at' => $item->date_added, 'updated_at' => $item->date_added]
                    );
            $operated_total = $point->total + $item->integral; // 操作之后的总数

            // 添加详细记录
            PointRecord::query()->create([
                'customer_id' => $item->customer_id,
                'description' => $item->description,
                'amount_changed' => $item->integral,
                'operated_total' => $operated_total,
                'order_id' => $item->order_id,
                'created_at' => $item->date_added,
                'updated_at' => $item->date_added,
            ]);

            $point->update(['total' => $operated_total, 'updated_at' => $item->date_added]);

        });
    }



    public function insertToMileage($item){
        DB::transaction(function () use ($item) {
            // 总记录
            $mileage = Mileage::query()->firstOrCreate(
                    ['customer_id' => $item->customer_id],
                    ['total' => 0.00, 'created_at' => $item->date_added, 'updated_at' => $item->date_added]
                    );
            $operated_total = bcadd($mileage->total, $item->mileage, 2); // 操作之后的总数

            // 添加详细记录
            MileageRecord::query()->create([
                'customer_id' => $item->customer_id,
                'description' => $item->description,
                'amount_changed' => $item->mileage,
                'operated_total' => $operated_total,
                'order_id' => $item->order_id,
                'created_at' => $item->date_added,
                'updated_at' => $item->date_added,
            ]);

            $mileage->update(['total' => $operated_total, 'updated_at' => $item->date_added]);

        });
    }



    public function insertToStoreCredit($item){
        DB::transaction(function () use ($item) {
            // 总记录
            $point = StoreCredit::query()->firstOrCreate(
                    ['customer_id' => $item->customer_id],
                    ['total' => 0, 'created_at' => $item->date_added, 'updated_at' => $item->date_added]
                    );
            $operated_total = bcadd($point->total, $item->amount, 2); // 操作之后的总数

            // 添加详细记录
            StoreCreditRecord::query()->create([
                    'customer_id' => $item->customer_id,
                'description' => $item->description,
                'amount_changed' => $item->amount,
                'operated_total' => $operated_total,
                'order_id' => $item->order_id,
                'created_at' => $item->date_added,
                'updated_at' => $item->date_added,
            ]);

            $point->update(['total' => $operated_total, 'updated_at' => $item->date_added]);

        });
    }
}
