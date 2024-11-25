<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'user_id',
        'count',
    ];

    public function items()
    {
        return $this->belongTo(Item::class);
    }

    public function users()
    {
        return $this->belongTo(User::class);
    }
}
