@extends('layouts.layout')

@section('content')
    <div class="max-w-3xl mx-auto bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6">
        {{-- Product Image --}}
        <div class="mb-6">
            @if ($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                    class="w-full h-64 object-cover rounded-xl">
            @else
                <img src="https://placehold.co/600x400?text={{ $product->name }}" alt="No Image"
                    class="w-full h-64 object-cover rounded-xl">
            @endif
        </div>

        {{-- Product Info --}}
        <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-4">
            {{ $product->name }}
        </h1>

        <p class="text-lg text-gray-700 dark:text-gray-300 mb-4">
            {{ $product->description ?? 'No description available.' }}
        </p>

        <div class="mb-4">
            <span class="text-gray-600 dark:text-gray-400 font-semibold">Price:</span>
            <span class="text-xl font-bold text-green-600 dark:text-green-400">
                ₹{{ number_format($product->price, 2) }}
            </span>
        </div>

        <div class="mb-4">
            <span class="text-gray-600 dark:text-gray-400 font-semibold">Category:</span>
            <span class="text-gray-900 dark:text-gray-200">
                {{ $product->category->name ?? 'Uncategorized' }}
            </span>
        </div>

        {{-- Actions --}}
        <div class="flex items-center gap-3 mt-6">
            <a href="{{ route('product.index') }}"
                class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600">
                Back to Products
            </a>

            <a href="{{ route('product.edit', $product->id) }}"
                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                Edit
            </a>


            <form action="{{ route('product.destroy', $product->id) }}" method="POST"
                onsubmit="return confirm('Are you sure you want to delete this {{ $product->name }}?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                    Delete
                </button>
            </form>
        </div>
    </div>
@endsection
