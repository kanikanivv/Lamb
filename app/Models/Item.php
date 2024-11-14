<?php

namespace App;

use Illuminate\Databese\Eloquent\Factories\HasFactory;
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
        return $this->hasMany(Item::class);
    }
    public function ItemSize() {
        return $this->hasMany(Item::class);
    }
    public function ItemGender() {
        return $this->hasMany(Item::class);
    }
    // public function Review() {
    //     return $this->hasMany(Item::class);
    // }
    public function Cart() {
        return $this->hasMany(Item::class);
    }
    public function OrderDetail() {
        return $this->hasMany(Item::class);
    }
    public function Categorie() {
        return $this->hasMany(Item::class);
    }
    // public function Like() {
    //     return $this->hasMany(Item::class);
    // }
}
