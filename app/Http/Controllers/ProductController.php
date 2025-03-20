<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function dashboard()
    {
        $models = Product::with('category')->get();
        dd($models);
        // return Inertia::render('Components/Dashboard', [
        //     'models' => $models
        // ]);
    }

    public function index()
    {
        $models = Product::with('category')->paginate(5);
        return Inertia::render('Product/Index','Components/Dashboard', [
            'models' => $models
        ]);
    }

    public function create()
    {
        $categories = Category::all();
        return Inertia::render('Product/Create', [
            'categories'    => $categories,
            'form_type'     => 'POST',
            'title'         => 'Create Product',
            'model'         => [],
            'route_url'     => route('products.store'),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'image'            => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
            'name'             => 'required',
            'category_id'      => 'required|exists:categories,id',
            'desc'             => 'required',
            'stock'            => 'required',
            'price'            => 'required',
        ]);

        // Menyimpan gambar jika ada
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'image'         => $imagePath,
            'name'          => $request->name,
            'category_id'   => $request->category_id,
            'desc'          => $request->desc,
            'stock'         => $request->stock,
            'price'         => $request->price,
        ]);

        return redirect()->route('products.index');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return Inertia::render('Product/Create', [
            'categories'    => $categories,
            'form_type' => 'PUT',
            'title' => 'Edit Product',
            'model' => $product,
            'route_url' => route('products.update', $product->id),
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'image'            => 'nullable',
            'name'             => 'required',
            'category_id'      => 'required|exists:categories,id',
            'desc'             => 'required',
            'stock'            => 'required',
            'price'            => 'required',
        ]);

        $imagePath = $product->image;
        if ($request->hasFile('image')) {
            if ($imagePath) {
                Storage::delete($imagePath);
            }
            $imagePath = $request->file('image')->store('products', 'public');
        }

        $product->update([
            'image'         => $imagePath,
            'name'          => $request->name,
            'category_id'   => $request->category_id,
            'desc'          => $request->desc,
            'stock'         => $request->stock,
            'price'         => $request->price,
        ]);

        return redirect()->route('products.index');
    }

    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::delete($product->image);
        }

        $product->delete();

        return redirect()->route('products.index');
    }
}
