<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();
        if (request()->has("search") && $request->search) {
            $query = $query->where("name", "like", "%" . $request->search . "%")
                ->orWhere("description", "like", "%" . $request->search . "%");
        }
        $products = $query->latest()->paginate(10);

        return view("product.products-list", compact("products"));
    }
    public function create()
    {
        // Fetch all categories to show in the product form
        $categories = Category::all();

        return view('product.products-create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "name"        => "required|string|max:100",       // product name, max 100 chars
            "description" => "nullable|string|max:500",       // optional, up to 500 chars
            "quantity"    => "required|integer|min:0",        // must be number >= 0
            "price"       => "required|numeric|min:0|max:999999.99", // price up to 999,999.99
            "category_id" => "required|exists:categories,id", // must match category
            "status"      => "required|in:active,in-active'",   // only active or inactive
            "image"       => "nullable|image|mimes:jpg,jpeg,png,webp|max:2048", // optional image, 2MB max
        ]);

        // store product
        $product = Product::create($validated);

        if ($request->hasFile("image")) {
            $path = $request->file("image")->store("products", "public");
            $product->image = $path;
            $product->save();
        }

        return redirect()->route("product.index")->with("success", "Product created successfully!");
    }
    public function show($id)
    {
        $product = Product::find($id);
        return view("product.show", compact("product"));
    }
    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        return view("product.edit", compact("product", "categories", "id"));
    }
    public function update(Request $request, $id)
    {

        $validated = $request->validate([
            "name"        => "required|string|max:100",
            "description" => "nullable|string|max:500",
            "quantity"    => "required|integer|min:0",
            "price"       => "required|numeric|min:0|max:999999.99",
            "category_id" => "required|exists:categories,id",
            "status"      => "required|in:active,in-active",
            "image"       => "nullable|image|mimes:jpg,jpeg,png,webp|max:2048",
        ]);


        // Handle new image if uploaded
        if ($request->hasFile('image')) {
            // delete old image if exists
            if ($request->image && Storage::disk("public")->exists($request->image)) {
                Storage::disk("public")->delete($request->image);
            }
            // save new image
            $validated['image'] = $request->file('image')->store('products', 'public');
        }
        Product::find($id)->update($validated);
        return redirect()->route('product.index')->with('success', 'Product updated successfully!');
    }
    public function destroy($id)
    {
        Product::find($id)->delete();
        return redirect()->route("product.index")->with("success", "Product Deleted Successfull!");
    }
    public function trashedProduct(Request $request)
    {
        $query = Product::query();
        if (request()->has("search") && $request->search) {
            $query = $query->where("name", "like", "%" . $request->search . "%")
                ->orWhere("description", "like", "%" . $request->search . "%");
        }
        $products = $query->onlyTrashed()->latest()->paginate(10);


        return view("product.trash-bin", compact("products"));
    }
    public function destoryProduct($id)
    {
        $product = Product::withTrashed()->find($id);
        //remove image 
        if ($product) {
            $product->forceDelete(); // permanently delete
            return redirect()->route("product.index")->with("success", "Product permanently deleted!");
        }

        return redirect()->route("product.index")->with("error", "Product not found!");
    }

    public function restoreProduct($id)
    {
        $product = Product::withTrashed()->find($id);

        if ($product) {
            $product->restore();
            return redirect()->route("product.trashedProduct")
                ->with("success", "Product restored successfully!");
        }

        return redirect()->route("product.trashedProduct")
            ->with("error", "Product not found!");
    }
}
