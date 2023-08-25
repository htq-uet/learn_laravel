<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "_order";

    protected function serializeDate(\DateTimeInterface $date)
    {
        $date->setTimezone('Asia/Ho_Chi_Minh');
        return $date->format('Y-m-d H:i:s');
    }

    protected $fillable = [
        'shop_id',
        'staff_id',
    ];
}
