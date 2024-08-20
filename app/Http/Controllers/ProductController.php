<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Service\ProductService;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductFullResource;

class ProductController extends Controller
{
    protected $productService;
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function getAllProducts(Request $request)
    {
        $products = $this->productService->getProducts($request);
        return response()->json($products, 200);
    }

    public function showProduct($slug)
    {
        $product = $this->productService->showProduct($slug);
        return new ProductFullResource($product);
    }

    public function showRandomProductsInMainPage()
    {
        $products = $this->productService->randomProducts();
        return response()->json(ProductResource::collection($products));
    }
}
