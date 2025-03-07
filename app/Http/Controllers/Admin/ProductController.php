<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.form');
    }

   
    public function store(Request $request)
    {
        Log::info('Received product data:', $request->all());
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'weight' => 'nullable',
            'price' => 'required|numeric|min:0',
            'category' => 'required|in:coffee,tea,refresh',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'stock' => 'required|integer|min:0',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $validatedData['image'] = '/storage/' . $imagePath;
        } else {
            return back()->withInput()->withErrors(['image' => 'The image field is required.']);
        }

        try {
            $product = Product::create($validatedData);
            Log::info('Product created:', ['id' => $product->id, 'name' => $product->name]);
            return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
        } catch (\Exception $e) {
            Log::error('Error creating product:', ['error' => $e->getMessage()]);
            return back()->withInput()->withErrors(['error' => 'Failed to create product. Please try again.']);
        }
    }

    public function edit(Product $product)
    {
        return view('admin.products.form', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'weight' => 'nullable',
            'price' => 'required|numeric|min:0',
            'category' => 'required|in:coffee,tea,refresh',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048|',
            'stock' => 'required|integer|min:0',

        ]);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete(str_replace('/storage/', '', $product->image));
            $imagePath = $request->file('image')->store('products', 'public');
            $validatedData['image'] = '/storage/' . $imagePath;
        }

        $product->update($validatedData);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        Storage::disk('public')->delete(str_replace('/storage/', '', $product->image));
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }
}

