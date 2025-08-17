@extends('layouts.layout')

@section('content')
    <h1 class="text-3xl font-bold mb-6 text-gray-800 dark:text-gray-100">Edit Product</h1>
    <x-product.form :product="$product" :categories="$categories" />
@endsection
