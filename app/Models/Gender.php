<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    use HasFactory;
    protected $table = 'genders';
    protected $fillable = [
        'gender_name',
        'created_at',
        'updated_at'
    ];

    public function Items() {
        return $this->hasMany(Item::class, 'item_gender_id');
    }
}
