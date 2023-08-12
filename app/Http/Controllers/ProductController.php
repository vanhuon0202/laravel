<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function product()
    {
        $products = Product::with('brand', 'category')->get();
        return view('product', compact('products'));
    }
    
    public function view()
    {
        $brands = Brand::all();
        $categories = Category::all();
        $products = Product::all();

        return view('product-admin',compact('brands', 'categories','products'));
    }

    public function save(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:products',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable',
            'image' =>'required|mimetypes:image/jpeg,image/png,image/gif,video/mp4|max:65536',
            'brand_id' => 'required|exists:brands,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $imageFilePath = $imageFile->store('public/images'); 
            $imageFileURL = '/storage/images/' . basename($imageFilePath);
        }
        
        $product = new Product([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $imageFileURL,
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
        ]);

        $product->save();

        return redirect()->route('product.view')->with('success', 'Product saved successfully.');
    }

    public function delete($id)
    {
        $Product = Product::find($id);
        
        if (!$Product) {
            return redirect()->back()->with('error', 'Product not found.');
        }

        $Product->delete();

        return redirect()->route('Product.view')->with('success', 'Product deleted successfully.');
    }

    public function show($id)
    {
        $product = Product::with('brand', 'category')->findOrFail($id);

        return response()->json([
            'name' => $product->name,
            'price' => $product->price,
            'description' => $product->description,
            'image' => $product->image,
            'brand' => $product->brandCategory['brand'],
            'category' => $product->brandCategory['category'],
        ]);
    }
}