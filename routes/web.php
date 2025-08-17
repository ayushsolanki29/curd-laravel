<?php

use App\Http\Controllers\ProductController;
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
