<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::with('category')
            ->when($request->query('q'), fn ($query, $q) =>
                $query->where('name', 'ilike', "%{$q}%"))
            ->when($request->query('category'), fn ($query, $slug) =>
                $query->whereHas('category', fn ($c) => $c->where('slug', $slug)))
            ->latest()
            ->paginate(12);

        return ProductResource::collection($products);
    }

    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['name']);

        $product = Product::create($data);

        return new ProductResource($product->load('category'));
    }

    public function show(Product $product)
    {
        return new ProductResource($product->load('category'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $data = $request->validated();

        if (isset($data['name'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        $product->update($data);

        return new ProductResource($product->load('category'));
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return response()->noContent();
    }
}