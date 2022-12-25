<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MileageRecord extends Model
{
    use HasFactory;
    protected $table = 'wa_mileage_record';
    protected $guarded = [];
    public $timestamps = false;
    
}
