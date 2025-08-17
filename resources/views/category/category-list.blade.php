@extends('layouts.layout')

@section('title', 'Category List')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Categories</h1>
        <a href="{{ route('category.create') }}" class="px-4 py-2 bg-green-600 text-white rounded">Add Category</a>
    </div>

 <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow-lg rounded-xl border border-gray-200 dark:border-gray-700">
    <table class="w-full text-sm text-left text-gray-600 dark:text-gray-300">
        <thead class="text-xs uppercase bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300">
            <tr>
                <th class="px-6 py-4">#</th>
                <th class="px-6 py-4">Name</th>
                <th class="px-6 py-4">Status</th>
                <th class="px-6 py-4 text-center">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
            @forelse ($categories as $category)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-150">
                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-gray-100">
                        {{ $loop->iteration }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $category->name }}
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 text-xs font-semibold rounded-full
                            {{ $category->status == 'active' 
                                ? 'bg-green-100 text-green-700 dark:bg-green-800 dark:text-green-200' 
                                : 'bg-red-100 text-red-700 dark:bg-red-800 dark:text-red-200' }}">
                            {{ ucfirst($category->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 flex items-center justify-center gap-2">
                        <a href="{{ route('category.edit', $category->id) }}"
                           class="inline-flex items-center px-3 py-1 text-xs font-medium rounded-lg 
                                  bg-indigo-600 text-white hover:bg-indigo-700 shadow">
                            Edit
                        </a>
                        <form action="{{ route('category.destroy', $category->id) }}" method="POST"
                              onsubmit="return confirm('Are you sure you want to delete this category?');">
                            @csrf @method('DELETE')
                            <button type="submit"
                                class="inline-flex items-center px-3 py-1 text-xs font-medium rounded-lg 
                                       bg-red-600 text-white hover:bg-red-700 shadow">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                        No Categories Found
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="p-4">
        {{-- {{ $categories->links() }} --}}
    </div>
</div>

@endsection
