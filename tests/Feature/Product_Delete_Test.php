<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class Product_Delete_Test extends TestCase
{
    use RefreshDatabase, WithFaker;
    public function test_product_delete(): void
    {
        $product = Product::factory()->create();

        $response = $this->deleteJson("/api/product/{$product->barcode}");

        $response->assertStatus(200);

        $response->assertJson([
            "message" => "Product deleted successfully"
        ]);

        $this->assertDatabaseMissing('products', ['barcode' => $product->barcode]);
    }
}
