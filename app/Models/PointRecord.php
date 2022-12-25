<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PointRecord extends Model
{
    use HasFactory;
    protected $table = 'wa_point_record';
    protected $guarded = [];
    public $timestamps = false;
    
}
