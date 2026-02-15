<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class Cannot_Update_Product_When_Selling_Price_Less_Than_Cost_Price_Test extends TestCase
{
    use RefreshDatabase, WithFaker;
    public function test_cannot_update_product_when_selling_price_less_than_cost_price(): void
    {
        $product = Product::factory()->create();

        $response = $this->putJson("/api/product/{$product->barcode}", [
            "product_name" => "Updated Product",
            "cost_price" => 120.00,
            "selling_price" => 80.00,
            "quantity" => 30,
            "minimum_stock" => 10
        ]);

        $response->assertStatus(422);
    }
}
