<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemSize extends Model
{
    public function Item() {
        return $this->belongsTo(Item::class);
    }

    public function Size() {
        return $this->belongsTo(Size::class);
    }
}
