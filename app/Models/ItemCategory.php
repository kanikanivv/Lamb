<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemCategory extends Model
{
    public function Item() {
        return $this->belongsTo(Item::class);
    }

    public function Gender() {
        return $this->belongsTo(Gender::class);
    }
}
