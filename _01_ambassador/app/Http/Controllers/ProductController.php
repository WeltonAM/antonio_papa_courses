<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Str;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    public function index()
    {
        return Product::all();
    }

    public function store(Request $request)
    {
        $product = Product::create($request->only('title', 'description', 'image', 'price'));

        return response($product, Response::HTTP_CREATED);
    }

    public function show(Product $product)
    {
        return $product;
    }

    public function update(Request $request, Product $product)
    {
        $product->update($request->only('title', 'description', 'image', 'price'));

        return response($product, Response::HTTP_ACCEPTED);
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function frontend()
    {
        if($products = Cache::get('products.frontend')) {
            return $products;
        }

        sleep(2);
        $products = Product::all();

        Cache::set('products.frontend', $products, 30 * 60);

        return $products;
    }

    public function backend(Request $request)
    {
        // Cache::forget('products.backend');

        $page = $request->get('page', 1);

        $products = Cache::remember('products.backend', 30 * 60, fn () => Product::all());

        if($s = $request->input('s')) {
            $products = $products->filter(fn (Product $product) => Str::contains($product->title, $s) || Str::contains($product->description, $s));
        }

        $total = $products->count();

        return [
            'data' => $products->forPage($page, 9)->values(),
            'meta' => [
                'total' => $total,
                'page' => $page,
                'last_page' => ceil($total / 9),
            ]
        ];
    }
}
