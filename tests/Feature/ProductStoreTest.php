<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductStoreTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_product_store(): void
    {
        $response = $this->postJson('/api/products', [
            "barcode" => "1234567890123",
            "product_name" => "Cot Sheet",
            "cost_price" => 850.00,
            "selling_price" => 1200.00,
            "quantity" => 50
        ]);

        $response->assertStatus(200);

        $response->assertJson([
            "message" => "Product created successfully"
        ]);

        $this->assertDatabaseHas('products', [
            "barcode" => "1234567890123",
            "product_name" => "Cot Sheet",
            "cost_price" => 850.00,
            "selling_price" => 1200.00,
            "quantity" => 50
        ]);
    }
}
