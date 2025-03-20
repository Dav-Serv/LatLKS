<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{
    public function index(){
        $models = Product::with('category')->paginate(5);
        return new PostResource(true, 'List Data Product', $models);
    }

    public function show($product){
        $models = Product::find($product);
        return new PostResource(true, 'Data Product', $models);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'image'            => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
            'name'             => 'required',
            'category_id'      => 'required|exists:categories,id',
            'desc'             => 'required',
            'stock'            => 'required',
            'price'            => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Menyimpan gambar jika ada
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        $models = Product::create([
            'image'         => $imagePath,
            'name'          => $request->name,
            'category_id'   => $request->category_id,
            'desc'          => $request->desc,
            'stock'         => $request->stock,
            'price'         => $request->price,
        ]);

        return new PostResource(true, 'Insert Data Product', $models);
    }

    public function update(Request $request,Product $product){
        $validator = Validator::make($request->all(), [
            'image'            => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'name'             => 'required',
            'category_id'      => 'required|exists:categories,id',
            'desc'             => 'required',
            'stock'            => 'required',
            'price'            => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // $models = Product::find($product);

        $imagePath = $product->image;
        if ($request->hasFile('image')) {
            if ($imagePath) {
                Storage::delete($imagePath);
            }
            $imagePath = $request->file('image')->store('products', 'public');

            $product->update([
                'image'         => $imagePath,
                'name'          => $request->name,
                'category_id'   => $request->category_id,
                'desc'          => $request->desc,
                'stock'         => $request->stock,
                'price'         => $request->price,
            ]);
        }else{
            $product->update([
                'name'          => $request->name,
                'category_id'   => $request->category_id,
                'desc'          => $request->desc,
                'stock'         => $request->stock,
                'price'         => $request->price,
            ]);
        }

        // $models->update($request->all());
        return new PostResource(true, 'Update Data Product', $product);
    }

    public function destroy(Product $product){
        if ($product->image) {
            Storage::delete($product->image);
        }

        $product->delete();
        
        return new PostResource(true, 'Update Data Product', $product);
    }
}
