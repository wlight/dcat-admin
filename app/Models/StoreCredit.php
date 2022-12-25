<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreCredit extends Model
{
    use HasFactory;
    protected $table = 'wa_store_credit';
    protected $guarded = [];
    public $timestamps = false;
    
}
