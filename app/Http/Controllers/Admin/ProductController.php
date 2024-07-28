<?php
namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::query()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('admin.products.index')->with('Product deleted Successfully');
    }
}
