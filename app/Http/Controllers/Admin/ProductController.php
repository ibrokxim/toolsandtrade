<?php
namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Http\Service\Admin\ProductService;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::query()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(ProductRequest $request, ProductService $productService)
    {
        $product = $productService->storeProduct($request);
        $product->save();
        return redirect()->route('admin.products.index')->with('Product created successfully');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    public function update(ProductRequest $request,$id, ProductService $productService)
    {
        $product = $productService->updateProduct($request, $id);

        return redirect()->route('admin.products.index')->with('Product updated successfully');
    }
    public function delete($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('admin.products.index')->with('Product deleted Successfully');
    }
}
