<?php

namespace App\Http\Controllers;

use App\Models\Product;

use Illuminate\Http\Request;


class ProductController extends Controller

{

    public function index(): \Illuminate\Http\JsonResponse

    {

        return response()->json(Product::all());

    }

    public function store(Request $request): \Illuminate\Http\JsonResponse

    {

        $validated = $request->validate([

            'name' => 'required',

            'price' => 'required|numeric',

            'description' => 'nullable',

        ]);

        $product = Product::create($validated);

        return response()->json($product, 201);

    }

    public function show(Product $product)

    {

        return response()->json($product);

    }

    public function update(Request $request, Product $product)

    {

        $validated = $request->validate([

            'name' => 'required',

            'price' => 'required|numeric',

            'description' => 'nullable',

        ]);

        $product->update($validated);

        return response()->json($product);

    }

    public function destroy(Product $product)

    {

        $product->delete();

        return response()->json([

            'message' => 'Product deleted successfully'

        ]);

    }

}

