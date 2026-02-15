<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'barcode' => 'required|unique:products,barcode',
            'product_name' => 'required|string',
            'cost_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0|gte:cost_price',
            'quantity' => 'required|integer',
            'minimum_stock' => 'required|integer',
        ]);

        $product = Product::create($validatedData);

        return response()->json([
            "message" => "Product created successfully"
            ], 200);
    }

    public function update(Request $request, $barcode)
    {
        $validatedData = $request->validate([
            "product_name" => 'required|string',
            "cost_price" => 'required|numeric|min:0',
            "selling_price" => 'required|numeric|min:0|gte:cost_price',
            "quantity" => 'required|integer',
            "minimum_stock" => 'required|integer',
        ]);

        $product = Product::findOrFail($barcode);
        $product->update($validatedData);

        return response()->json([
            "message" => "Product updated successfully"
        ], 200);
    }

    public function delete(Request $request, $barcode)
    {
        $product = Product::findOrFail($barcode);
        
        $product->delete();

        return response()->json([
            "message" => "Product deleted successfully"
        ], 200);
    }
}
