{{-- Name --}}
<div>
    <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">
        Product Name <span class="text-red-500">*</span>
    </label>
    <input type="text" name="name" 
        value="{{ old('name', $product->name ?? '') }}"
        class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100 
               focus:ring-2 focus:ring-blue-500 focus:border-blue-500 p-3 h-12"
        placeholder="Enter product name">
    @error('name')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

{{-- Description --}}
<div>
    <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Description</label>
    <textarea name="description" rows="5"
        class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100 
               focus:ring-2 focus:ring-blue-500 focus:border-blue-500 p-3 h-32"
        placeholder="Enter product description">{{ old('description', $product->description ?? '') }}</textarea>
    @error('description')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

{{-- Quantity & Price --}}
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Quantity</label>
        <input type="number" name="quantity" 
            value="{{ old('quantity', $product->quantity ?? '') }}"
            class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100 
                   focus:ring-2 focus:ring-blue-500 focus:border-blue-500 p-3 h-12" min="0">
        @error('quantity')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">
            Price <span class="text-red-500">*</span>
        </label>
        <input type="number" step="0.01" name="price" 
            value="{{ old('price', $product->price ?? '') }}"
            class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100 
                   focus:ring-2 focus:ring-blue-500 focus:border-blue-500 p-3 h-12"
            placeholder="0.00">
        @error('price')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>
</div>

{{-- Category & Status --}}
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">
            Category <span class="text-red-500">*</span>
        </label>
        <select name="category_id"
            class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100 
                   focus:ring-2 focus:ring-blue-500 focus:border-blue-500 p-3 h-12">
            <option value="">Select a category</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}"
                    {{ old('category_id', $product->category_id ?? '') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        @error('category_id')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Status</label>
        <select name="status"
            class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100 
                   focus:ring-2 focus:ring-blue-500 focus:border-blue-500 p-3 h-12">
            <option value="active" {{ old('status', $product->status ?? '') == 'active' ? 'selected' : '' }}>Active</option>
            <option value="in-active" {{ old('status', $product->status ?? '') == 'in-active' ? 'selected' : '' }}>Inactive</option>
        </select>
        @error('status')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>
</div>

{{-- Product Image --}}
<div>
    <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Product Image</label>

    {{-- Preview Current Image --}}
    <div class="mb-4">
        @if (!empty($product) && $product->image)
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                class="w-32 h-32 object-cover rounded-lg shadow-md border-2 border-gray-300 bg-gray-100">
        @else
            <img src="https://placehold.co/150x150?text=No+Image" alt="No Image"
                class="w-32 h-32 object-cover rounded-lg shadow-md">
        @endif
    </div>

    {{-- File Input --}}
    <input type="file" name="image"
        class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100 
               focus:ring-2 focus:ring-blue-500 focus:border-blue-500 p-3 h-12">

    <p class="text-xs text-gray-500 mt-1">Leave empty if you don’t want to change the image.</p>

    @error('image')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>
