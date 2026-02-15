<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Product::class;
    public function definition(): array
    {
        return [
            "barcode" => $this->faker->unique()->numerify('##########'),
            "product_name" => $this->faker->word(),
            "cost_price" => $this->faker->randomFloat(2, 1, 100),
            "selling_price" => $this->faker->randomFloat(2, 1, 100),
            "quantity" => $this->faker->numberBetween(1, 100),
            "minimum_stock" => $this->faker->numberBetween(1, 10),
        ];
    }
}
