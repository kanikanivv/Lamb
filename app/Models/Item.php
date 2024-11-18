<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable = [
        'item_category_id',
        'item_size_id',
        'item_gender_id',
        'item_name',
        'price',
        'item_comment',
        'item_count',
        'created_at',
        'update_at'
    ];

    public function ItemImage() {
        return $this->hasMany(ItemImage::class);
    }
    public function ItemSize() {
        return $this->hasMany(ItemSize::class);
    }
    public function ItemGender() {
        return $this->hasMany(ItemGender::class);
    }
    public function ItemCategory() {
        return $this->hasMany(ItemCategory::class);
    }
    // public function Review() {
    //     return $this->hasMany(Review::class);
    // }
    public function Cart() {
        return $this->hasMany(Cart::class);
    }
    public function OrderDetail() {
        return $this->hasMany(OrderDetail::class);
    }
    // public function Like() {
    //     return $this->hasMany(Like::class);
    // }
}
