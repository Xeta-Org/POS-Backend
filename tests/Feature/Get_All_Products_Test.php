<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class Get_All_Products_Test extends TestCase
{
    use RefreshDatabase, WithFaker;
    public function test_example(): void
    {
        $products = Product::factory()->count(3)->create();

        $response = $this->get('/api/products');

        $response->assertStatus(200);
        $response->assertJsonCount(3);
        $response->assertJsonStructure([
            '*' => [
                'barcode',
                'product_name',
                'cost_price',
                'selling_price',
                'quantity',
                'minimum_stock',
                'created_at',
                'updated_at',
            ],
        ]);
    }
}
