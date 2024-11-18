<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'catecogories';
    protected $fillabe = [
        'category_name',
        'created_at',
        'update_at'
    ];

    public function ItemGCategory() {
        return $this->hasMany(ItemGCategory::class);
    }
}
