<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    public $fillable = [
        'user_id',
        'item_id',
        'item_count',
        'price',
    ];

    public function User() {
        return $this->belongsTo(User::class);
    }

    public function Item() {
        return $this->belongsTo(Item::class);
    }

}
