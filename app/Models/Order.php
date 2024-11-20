<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillabe = [
        'user_id',
        'billing_amount',
        'created_at',
        'update_at'
    ];

    public function OrderDetail() {

    }

    public function User() {

    }

    public function Recommendation() {

    }

}
