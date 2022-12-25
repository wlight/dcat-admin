<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	use HasDateTimeFormatter, HasFactory;

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
