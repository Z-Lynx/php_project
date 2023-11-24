<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $price = $this->faker->numberBetween($min=100 , $max= 900);
        return [
            'category_id' => $this->faker->numberBetween($min=1 , $max= 9),
            'name' => $this->faker->name(25),
            'slug' => $this->faker->slug(),
            'description' => $this->faker->text(100),
            'image' => $this->faker->imageUrl($width = 140, $height = 300),
            'price' => $price,
            'sale_price' => $price - 50,
            'created_at' => now(),
        ];
    }
}
