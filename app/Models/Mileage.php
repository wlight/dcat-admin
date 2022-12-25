<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mileage extends Model
{
    use HasFactory;
    protected $table = 'wa_mileage';
    protected $guarded = [];
    public $timestamps = false;
    
}
