<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreCreditRecord extends Model
{
    use HasFactory;
    protected $table = 'wa_store_credit_record';
    protected $guarded = [];
    public $timestamps = false;
    
}
