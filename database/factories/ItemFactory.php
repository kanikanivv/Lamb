<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item
 */
class ItemFactory extends Factory
{
    /**
     * モデルと対応するファクトリの名前
     *
     * @var string
     */
    protected $model = items::class;
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'item_category_id' => rand(1, 10),
            'item_size_id' => rand(1, 10),
            'item_gender_id' => rand(1, 10),
            'item_name' => $this->faker->name(),
            'item_price'  => rand(1, 10),
            'item_comment' =>rand(1000, 10000),
            'item_count' =>$this->faker->text(100),
            'created_at' => now(),
            'update_at' => now(),
        ];
    }

}
