<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
