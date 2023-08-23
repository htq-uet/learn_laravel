<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $table = "staff";
    public $timestamps = false;
    protected $fillable = [
        'name',
        'phone',
        'user_id',
        'shop_id',
        'status'
    ];


}
