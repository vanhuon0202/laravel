<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    public function view()
    {
        $categories = Category::all();
        return view('category-admin', compact('categories'));
    }

    public function save(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
        ]);

        $existingCategory = category::where('name', $validatedData['name'])->first();

        if ($existingCategory) {
            return back()->with('error', 'The category name already exists. Please choose another name.');
        }

        $category = new Category();
        $category->name = $validatedData['name'];
        $category->save();

        return back()->with('success', 'Category created successfully');
    }

    public function delete($id)
    {
        $category = Category::find($id);
        
        if (!$category) {
            return redirect()->back()->with('error', 'Category not found.');
        }

        $category->delete();

        return redirect()->route('category.view')->with('success', 'Category deleted successfully.');
    }

    

    public function getCategories()
    {
        $categories = Category::orderBy('sort', 'desc')->get();
        return response()->json($categories);
    }
}