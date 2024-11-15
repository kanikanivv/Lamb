<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemGender extends Model
{
    protected $fillabe = [
        'gender_id',
        'item_id',
        'created_at',
        'update_at'
    ];

    public function Item() {
        return $this->belongsTo(Item::class);
    }

    public function Gender() {
        return $this->belongsTo(Gender::class);
    }
}
