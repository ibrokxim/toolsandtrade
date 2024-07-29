<?php
namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

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

    public function store(Request $request)
    {
        $validated = request()->validate([
           'name' => 'required',
           'slug' => 'required',
           'short_description' => 'required',
           'description' => 'required',
           'characteristic' => 'required',
           'image' => 'nullable|image|max:10000'
        ]);

        $product = new Product($validated);

        if ($request->hasFile('image')) {
            $product->image = $request->file('image')->store('products', 'public');
        }

        $product->save();
        return redirect()->route('admin.products.index')->with('Product created successfully');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request,$id)
    {
        $validated = request()->validate([
           'name' => 'required',
           'slug' => 'required',
           'short_description' => 'required',
           'description' => 'required',
           'characteristic' => 'required',
           'image' => 'nullable|image',
        ]);
        $product = Product::query()->findOrFail($id);
        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            $photoPath = $request->file('image')->store('big_categories', 'public');
            $validated['image'] = $photoPath;
        }
        $product->update($validated);
        return redirect()->route('admin.products.index')->with('Product updated successfully');
    }
    public function delete($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('admin.products.index')->with('Product deleted Successfully');
    }
}
