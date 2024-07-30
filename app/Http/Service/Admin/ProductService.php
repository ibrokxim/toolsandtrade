<?php

namespace App\Http\Service\Admin;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\ProductRequest;

class ProductService
{
    public function storeProduct(ProductRequest $request)
    {
        $validated = $request->validated();
        $product = new Product($validated);

        if ($request->hasFile('image')) {
            $product->image = $request->file('image')->store('products', 'public');
        }
        return $product;
    }

    public function updateProduct(ProductRequest $request, $id)
    {
        $validated = $request->validated();
        $product = Product::query()->findOrFail($id);
        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $photoPath = $request->file('image')->store('big_categories', 'public');
            $validated['image'] = $photoPath;
        }
        $product->update($validated);
        return $product;
    }
}
