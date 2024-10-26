<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCreateRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    public function index()
    {
        Gate::allows('view', 'product');

        $products = Product::paginate();

        return ProductResource::collection($products);
    }

    public function show(Product $product)
    {
        Gate::allows('view', 'product');

        $product = Product::find($product->id);

        return new ProductResource($product);
    }

    public function store(ProductCreateRequest $request)
    {
        Gate::allows('edit', 'product');

        $product = Product::create($request->only('title', 'description', 'image', 'price'));

        return response(new ProductResource($product), Response::HTTP_CREATED);
    }

    public function update(Request $request, Product $product)
    {
        Gate::allows('edit', 'product');

        $product = Product::find($product->id);

        $product->update($request->only('title', 'description', 'image', 'price'));

        return response(new ProductResource($product), Response::HTTP_ACCEPTED);
    }

    public function destroy(Product $product)
    {
        Gate::allows('edit', 'product');

        Product::destroy($product->id);

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
