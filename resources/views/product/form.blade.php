{{-- Name --}}
<div>
    <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">
        Product Name <span class="text-red-500">*</span>
    </label>
    <input type="text" name="name" value="{{ old('name') }}"
        class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100 
               focus:ring-2 focus:ring-blue-500 p-3 h-12"
        placeholder="Enter product name" >
    @error('name')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

{{-- Description --}}
<div>
    <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Description</label>
    <textarea name="description" rows="5"
        class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100 
               focus:ring-2 focus:ring-blue-500 p-3 h-32"
        placeholder="Enter product description">{{ old('description') }}</textarea>
    @error('description')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

{{-- Quantity & Price --}}
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Quantity</label>
        <input type="number" name="quantity" value="{{ old('quantity') }}"
            class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100 
                   focus:ring-2 focus:ring-blue-500 p-3 h-12"
            min="0">
        @error('quantity')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">
            Price <span class="text-red-500">*</span>
        </label>
        <input type="number" step="0.01" name="price" value="{{ old('price') }}"
            class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100 
                   focus:ring-2 focus:ring-blue-500 p-3 h-12"
            placeholder="0.00">
        @error('price')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div>
    <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">
        Category <span class="text-red-500">*</span>
    </label>
    <select name="category_id"
        class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100 
               focus:ring-2 focus:ring-blue-500 p-3 h-12">
        <option value="">Select a category</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
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
               focus:ring-2 focus:ring-blue-500 p-3 h-12">
        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
        <option value="in-active" {{ old('status') == 'in-active' ? 'selected' : '' }}>Inactive</option>
    </select>
    @error('status')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>
</div>



{{-- Image --}}
<div>
    <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Product Image</label>
    <input type="file" name="image"
        class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100 
               focus:ring-2 focus:ring-blue-500 p-3 h-12">
    @error('image')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

{{-- Submit Button --}}
