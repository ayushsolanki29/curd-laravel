@extends('layouts.layout')

@section('title', 'Product List')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <!-- Title & Subtitle -->
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Product List</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">Manage your store products</p>
        </div>
        <div class="hidden md:flex flex-1 mx-6">
            <input type="text" placeholder="Search for products..."
                class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-700 focus:ring-2 focus:ring-indigo-500 outline-none">
        </div>
        <!-- Add New Product Button -->
        <div>
            <a href="/products/create"
                class="inline-flex mr-2 items-center px-4 py-2 bg-yellow-600 text-white text-sm font-medium rounded-lg shadow hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-1 dark:focus:ring-offset-gray-900">
                <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i>
                Trash bin
            </a>
            <a href="/products/create"
                class="inline-flex items-center px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-lg shadow hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-1 dark:focus:ring-offset-gray-900">
                <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
                Add New Product
            </a>
        </div>
    </div>

    <!-- Products Table -->
    <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow-md rounded-lg">
        <table class="w-full border-collapse">
            <thead class="bg-gray-100 dark:bg-gray-700">
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 dark:text-gray-300">#</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 dark:text-gray-300">Name</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 dark:text-gray-300">Category</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 dark:text-gray-300">Price</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 dark:text-gray-300">Quantity</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 dark:text-gray-300">Status</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 dark:text-gray-300">Description</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 dark:text-gray-300">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                    <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                        <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3 text-sm font-medium text-gray-800 dark:text-gray-100">
                            {{ $product->name }}
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-400">
                            {{ $product->category->name }}
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-200">
                            ₹{{ number_format($product->price, 2) }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            @php
                                $status = '';
                                $classes = '';

                                if ($product->quantity == 0) {
                                    $status = 'Out of Stock';
                                    $classes = 'bg-red-100 text-red-700 dark:bg-red-800 dark:text-red-200';
                                } elseif ($product->quantity > 0 && $product->quantity < 10) {
                                    $status = 'Low Stock';
                                    $classes = 'bg-yellow-100 text-yellow-700 dark:bg-yellow-800 dark:text-yellow-200';
                                } else {
                                    $status = 'In Stock';
                                    $classes = 'bg-green-100 text-green-700 dark:bg-green-800 dark:text-green-200';
                                }
                            @endphp

                            <span class="px-2 py-1 text-xs font-medium rounded-full {{ $classes }}">
                                {{ $status }} ({{ $product->quantity }})
                            </span>

                        </td>
                        <td class="px-4 py-3 text-sm">
                            <span
                                class="px-2 py-1 text-xs rounded-full 
                                {{ $product->status == 'active' ? 'bg-green-100 text-green-700 dark:bg-green-800 dark:text-green-200' : 'bg-red-100 text-red-700 dark:bg-red-800 dark:text-red-200' }}">
                                {{ $product->status == 'active' ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-400 truncate max-w-[200px]">
                            {{ $product->description }}
                        </td>
                        <td class="px-4 py-3 text-sm flex space-x-2">
                            <!-- Edit -->
                            <a href=""
                                class="inline-flex items-center px-3 py-1 text-xs bg-indigo-600 text-white rounded hover:bg-indigo-700">
                                <i data-lucide="edit" class="w-4 h-4 mr-1"></i>
                                Edit
                            </a>
                            <!-- Delete -->
                            <form action="" method="POST" onsubmit="return confirm('Delete this product?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="inline-flex items-center px-3 py-1 text-xs bg-red-600 text-white rounded hover:bg-red-700">
                                    <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i>
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr class="border-b border-gray-200 dark:border-gray-700">
                        <td colspan="8" class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300 text-center">
                            No Products Found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
