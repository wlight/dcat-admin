<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class MileageRecord extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'wa_mileage_record';

}
