@extends('layouts.layout')

@section('content')
    <h1 class="text-3xl font-bold mb-6 text-gray-800 dark:text-gray-100">Add New Product</h1>
    <form action="{{ route(name: 'product.store') }}" method="POST" enctype="multipart/form-data"
        class="space-y-6 bg-white dark:bg-gray-900 p-6 rounded-xl shadow-md">

        @csrf

        @include('product.form')
        <div class="flex justify-end">
            <button type="submit"
                class="px-6 py-3 rounded-lg bg-blue-600 hover:bg-blue-700 text-white font-medium shadow-md">
                Create Product
            </button>
        </div>

    </form>
@endsection
