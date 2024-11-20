<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'image_name',
        'image_color',
        'created_at',
        'update_at'
    ];

    public function ItemImage() {
        return $this->hasMany(ItemImage::class, 'image_id');
    }
}
