<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    protected $fillabe = [
        'gender_name',
        'created_at',
        'update_at'
    ];

    public function ItemGender() {
        return $this->hasMany(ItemGender::class);
    }
}
