<?php

namespace Database\Factories;

use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

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
    protected $model = Item::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'item_category_id' => $this->faker->numberBetween(1, 10),
            'item_size_id' => $this->faker->numberBetween(1, 10),
            'item_gender_id' => $this->faker->numberBetween(1, 10),
            'item_name' => $this->faker->name(),
            'item_price'  => $this->faker->randomFloat,
            'item_comment' => $this->faker->sentence,
            'quantity' => $this->faker->numberBetween(1, 20),
        ];
    }

}
