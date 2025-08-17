<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
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

        return redirect()->route("products.index")->with("success", "Product created successfully!");
    }
}
