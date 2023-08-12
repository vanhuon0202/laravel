<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
    public function view()
    {
        $brands = brand::all();
        return view('brand-admin', compact('brands'));
    }

    public function save(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
        ]);

        $existingbrand = brand::where('name', $validatedData['name'])->first();

        if ($existingbrand) {
            return back()->with('error', 'The brand name already exists. Please choose another name.');
        }
        $name = $request->input('name');
        
        $brand = new Brand();
        $brand->name =$name;
        $brand->save();

        return back()->with('success', 'brand created successfully');
    }

    public function delete(Brand $id)
    {
        $brand = Brand::find($id);
        
        if (!$brand) {
            return redirect()->back()->with('error', 'brand not found.');
        }
        
        $brand->delete();
        return redirect()->route('brand.view')->with('success', 'brand deleted successfully.');
    }

    public function getCategories()
    {
        $brands = bBrand::orderBy('sort', 'desc')->get();
        return response()->json($brands);
    }
}