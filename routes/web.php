<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/products', [ProductController::class, 'index'])->name("product.index");
Route::get('/products/create', [ProductController::class, 'create'])->name("product.create");
Route::post('/products/store-product', [ProductController::class, 'store'])->name("product.store");
Route::get('/products/show/{id}', [ProductController::class, 'show'])->name("product.show");
Route::get('/products/edit/{id}', [ProductController::class, 'edit'])->name("product.edit");
Route::post('/products/update-product/{id}', [ProductController::class, 'update'])->name("product.update");

Route::delete('/products/destroy-product/{id}', [ProductController::class, 'destroy'])->name("product.destroy");

Route::get('/products/deleted-products', [ProductController::class, 'trashedProduct'])->name("product.trashedProduct");

Route::delete("/product/delete-product/{id}", [ProductController::class, 'destoryProduct'])->name("product.delete");
Route::post("/product/restore-product/{id}", [ProductController::class, 'restoreProduct'])->name("product.restore");


// Category CRUD Routes
Route::get('/categories', [CategoryController::class, 'index'])->name("category.index");
Route::get('/categories/create', [CategoryController::class, 'create'])->name("category.create");
Route::post('/categories/store-category', [CategoryController::class, 'store'])->name("category.store");
Route::get('/categories/show/{id}', [CategoryController::class, 'show'])->name("category.show");
Route::get('/categories/edit/{id}', [CategoryController::class, 'edit'])->name("category.edit");
Route::post('/categories/update-category/{id}', [CategoryController::class, 'update'])->name("category.update");

// Soft Delete
Route::delete('/categories/destroy-category/{id}', [CategoryController::class, 'destroy'])->name("category.destroy");

// Trashed Categories
Route::get('/categories/deleted-categories', [CategoryController::class, 'trashedCategory'])->name("category.trashedCategory");

// Force Delete & Restore
Route::delete("/categories/delete-category/{id}", [CategoryController::class, 'deleteCategory'])->name("category.delete");
Route::post("/categories/restore-category/{id}", [CategoryController::class, 'restoreCategory'])->name("category.restore");
