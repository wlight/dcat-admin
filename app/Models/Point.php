<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'wa_point';

    public function recored()
    {
        return $this->hasMany(Point::class, 'customer_id', 'customer_id');
    }

}
