<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerTransaction extends Model
{
    use HasFactory;
    protected $primaryKey = 'customer_transaction_id';
    protected $table = 'wa_customer_transaction';
}
