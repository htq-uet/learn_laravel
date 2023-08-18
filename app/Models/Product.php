<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
//    public $timestamps = false;
    protected $table = "product";

    protected function serializeDate(\DateTimeInterface $date)
    {
        $date->setTimezone('Asia/Ho_Chi_Minh');
        return $date->format('Y-m-d H:i:s');
    }

    protected $fillable = [
        'name',
        'price',
        'shop_id',
        'staff_id',
    ];

}
