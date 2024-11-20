<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $table = 'sizes';
    protected $fillabe = [
        'size_name',
        'created_at',
        'update_at'
    ];

    public function Item() {
        return $this->hasMany(Item::class);
    }
}