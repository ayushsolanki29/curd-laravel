@extends('layouts.layout')

@section('title', 'Trash Bin')

@section('content')
    <form action="{{ route('product.trashedProduct') }}" method="GET" class="w-full">
        <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">

            <!-- Title & Subtitle -->
            <div class="text-center md:text-left">
                <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Trash Bin</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">Manage your deleted products (Restore or Delete
                    permanently)</p>
            </div>

            <!-- Search Bar -->
            <div class="flex w-full md:w-1/2 lg:w-1/3 items-center gap-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search deleted products..."
                    class="flex-1 px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-700 
                          bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-gray-100
                          focus:ring-2 focus:ring-indigo-500 outline-none">

                <button type="submit"
                    class="px-4 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium shadow">
                    Search
                </button>

                @if (request('search'))
                    <a href="{{ route('product.trashedProduct') }}"
                        class="px-4 py-2 rounded-lg bg-gray-500 hover:bg-gray-600 text-white text-sm font-medium shadow">
                        Reset
                    </a>
                @endif
            </div>

            <!-- Back Button -->
            <div class="flex gap-2">
                <a href="{{ route('product.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-600 text-white text-sm font-medium rounded-lg shadow hover:bg-gray-700">
                    <i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i>
                    Back To Product List
                </a>
            </div>
        </div>
    </form>

    <!-- Products Table -->
    <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow-md rounded-lg">
        <table class="w-full border-collapse">
            <thead class="bg-gray-100 dark:bg-gray-700">
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 dark:text-gray-300">#</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 dark:text-gray-300">Product</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 dark:text-gray-300">Category</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 dark:text-gray-300">Price</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 dark:text-gray-300">Stock</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 dark:text-gray-300">Status</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 dark:text-gray-300">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                    <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                        <!-- Index -->
                        <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">{{ $loop->iteration }}</td>

                        <!-- Product Info -->
                        <td class="px-4 py-3 text-sm font-medium text-gray-800 dark:text-gray-100">
                            <div class="flex items-center space-x-3">
                                <div
                                    class="w-12 h-12 flex items-center justify-center overflow-hidden rounded-lg bg-gray-200 dark:bg-gray-700">
                                    @if ($product->image && file_exists(public_path('storage/' . $product->image)))
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                            class="w-full h-full object-cover">
                                    @else
                                        <span class="text-gray-500 text-xs">No Img</span>
                                    @endif
                                </div>
                                <span>{{ $product->name }}</span>
                            </div>
                        </td>

                        <!-- Category -->
                        <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-400">
                            {{ $product->category->name }}
                        </td>

                        <!-- Price -->
                        <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-200">
                            ₹{{ number_format($product->price, 2) }}
                        </td>

                        <!-- Stock -->
                        <td class="px-4 py-3 text-sm">
                            @php
                                if ($product->quantity == 0) {
                                    $stockText = 'Out of Stock';
                                    $stockClass = 'bg-red-100 text-red-700 dark:bg-red-800 dark:text-red-200';
                                } elseif ($product->quantity < 10) {
                                    $stockText = 'Low Stock';
                                    $stockClass =
                                        'bg-yellow-100 text-yellow-700 dark:bg-yellow-800 dark:text-yellow-200';
                                } else {
                                    $stockText = 'In Stock';
                                    $stockClass = 'bg-green-100 text-green-700 dark:bg-green-800 dark:text-green-200';
                                }
                            @endphp
                            <span class="px-2 py-1 text-xs font-medium rounded-full {{ $stockClass }}">
                                {{ $stockText }} ({{ $product->quantity }})
                            </span>
                        </td>

                        <!-- Status -->
                        <td class="px-4 py-3 text-sm">
                            <span
                                class="px-2 py-1 text-xs rounded-full 
                                {{ $product->status == 'active' ? 'bg-green-100 text-green-700 dark:bg-green-800 dark:text-green-200' : 'bg-red-100 text-red-700 dark:bg-red-800 dark:text-red-200' }}">
                                {{ $product->status == 'active' ? 'Active' : 'Inactive' }}
                            </span>
                        </td>

                        <!-- Actions -->
                        <td class="px-4 py-3 text-sm flex space-x-2">
                            <!-- Restore -->
                            <form action="{{ route('product.restore', $product->id) }}" method="POST">
                                @csrf

                                <button type="submit"
                                    class="inline-flex items-center px-3 py-1 text-xs bg-green-600 text-white rounded hover:bg-green-700">
                                    <i data-lucide="undo-2" class="w-4 h-4 mr-1"></i>
                                    Restore
                                </button>
                            </form>

                            <!-- Permanent Delete -->
                            <form action="{{ route('product.delete', $product->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to permanently delete {{ $product->name }}? This action cannot be undone.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="inline-flex items-center px-3 py-1 text-xs bg-red-600 text-white rounded hover:bg-red-700">
                                    <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i>
                                    Delete Permanently
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr class="border-b border-gray-200 dark:border-gray-700">
                        <td colspan="7" class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300 text-center">
                            No deleted products found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="m-3">
            {{ $products->links() }}
        </div>
    </div>
@endsection
