<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class Cannot_Create_Product_When_Selling_Price_Less_Than_Cost_Price_Test extends TestCase
{
    use RefreshDatabase, WithFaker;
    public function test_cannot_create_product_when_selling_price_less_than_cost(): void
    {
        $response = $this->postJson('/api/products',[
            "barcode" => "1234567890",
            "product_name" => "Test Product",
            "cost_price" => 100.00,
            "selling_price" => 80.00,
            "quantity" => 20,
            "minimum_stock" => 5
        ]);

        $response->assertStatus(422);
    }
}
