<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{

    use HasFactory;

    protected $fillable = [
        'name',
        'color',
        'path',
        'created_at',
        'update_at'
    ];

    public function items() {
        return $this->belongsToMany(Item::class, 'image_item');
    }
}
