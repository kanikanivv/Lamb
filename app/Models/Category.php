<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillabe = [
        'category_name',
        'created_at',
        'update_at'
    ];

    public function Item() {
        return $this->hasMany(Item::class, 'item_category_id');
    }
}
