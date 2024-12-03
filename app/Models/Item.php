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
        'item_price',
        'item_comment',
        'quantity',
        'created_at',
        'update_at'
    ];

    // 性別
    public function Gender() {
        return $this->belongsTo(Gender::class, 'item_gender_id');
    }

    // カテゴリー
    public function Category() {
        return $this->belongsTo(Category::class, 'item_category_id');
    }

    // サイズ
    public function size() {
        return $this->belongsTo(Size::class, 'item_size_id');
    }

    // 画像
    public function images() {
        return $this->belongsToMany(Image::class, 'image_item');
    }
}
