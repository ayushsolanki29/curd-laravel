@extends('layouts.layout')

@section('content')
    <h1 class="text-3xl font-bold mb-6 text-gray-800 dark:text-gray-100">Add New Product</h1>
    <form action="{{ route(name: 'product.store') }}" method="POST" enctype="multipart/form-data"
        class="space-y-6 bg-white dark:bg-gray-900 p-6 rounded-xl shadow-md">

        @csrf

        @include('product.form')
    </form>
@endsection
