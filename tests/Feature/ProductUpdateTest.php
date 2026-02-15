<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductUpdateTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    public function test_update_product(): void
    {
        $product = Product::create([
            "barcode" => "1234567890",
            "product_name" => "Test Product",
            "cost_price" => 100.00,
            "selling_price" => 150.00,
            "quantity" => 20,
            "minimum_stock" => 5
        ]);

        $response = $this->putJson("/api/product/{$product->barcode}", [
            "product_name" => "Updated Product",
            "cost_price" => 120.00,
            "selling_price" => 180.00,
            "quantity" => 30,
            "minimum_stock" => 10
        ]);

        $response->assertStatus(200);

        $response->assertJson([
            "message" => "Product updated successfully"
        ]);

        $this->assertDatabaseHas('products', [
            "barcode" => "1234567890",
            "product_name" => "Updated Product",
            "cost_price" => 120.00,
            "selling_price" => 180.00,
            "quantity" => 30,
            "minimum_stock" => 10
        ]);
    }
}
