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
        'item_count',
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

    // 画像
    public function Image() {
        return $this->belongsTo(Image::class, 'item_image_id');
    }


}
