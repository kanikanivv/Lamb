<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemImage extends Model
{
    protected $fillable = [
        'image_id',
        'item_id',
        'created_at',
        'update_at'
    ];

    public function Image() {
        $this->belongsTo(Image::class, 'image_id');
    }

    public function Item() {
        $this->belongsTo(Item::class, 'item_id');
    }
}
