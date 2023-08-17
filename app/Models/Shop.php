<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $table = "shop";
    public $timestamps = false;
    protected $fillable = [
        'name',
        'address',
        'phone',
        'user_id'
    ];


}
