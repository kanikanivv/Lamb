<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    protected $table = 'genders';
    protected $fillabe = [
        'gender_name',
        'created_at',
        'update_at'
    ];

    public function Items() {
        return $this->hasMany(Item::class, 'item_gender_id');
    }
}
