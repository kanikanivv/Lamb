<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'billing_amount',
        'purchase_id',
        'created_at',
        'update_at'
    ];

    public function OrderDetail() {

    }

    public function User() {
        return $this->belongsTo(User::class);
    }

    public function Recommendation() {

    }

}
