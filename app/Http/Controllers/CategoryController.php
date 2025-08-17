<?php
namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view("category.category-list", compact("categories"));
    }

    public function create()
    {
        return view("category.create");
    }

    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|string|max:255",
        ]);

        Category::create([
            "name" => $request->name,
        ]);

        return redirect()->route("category.index")->with("success", "Category created successfully!");
    }


    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view("category.edit", compact("category"));
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            "name" => "required|string|max:255",
        ]);

        $category->update([
            "name" => $request->name,
        ]);

        return redirect()->route("category.index")->with("success", "Category updated successfully!");
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route("category.index")->with("success", "Category deleted (soft)!");
    }

    public function trashedCategory()
    {
        $categories = Category::onlyTrashed()->get();
        return view("category.trash-bin", compact("categories"));
    }

    public function restoreCategory($id)
    {
        $category = Category::withTrashed()->findOrFail($id);
        $category->restore();

        return redirect()->route("category.index")->with("success", "Category restored successfully!");
    }

    public function deleteCategory($id)
    {
        $category = Category::withTrashed()->findOrFail($id);
        $category->forceDelete();

        return redirect()->route("category.index")->with("success", "Category permanently deleted!");
    }
}
