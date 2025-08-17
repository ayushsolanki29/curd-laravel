    <!-- ✅ Header / Top Bar -->
    <header class="bg-white dark:bg-gray-800 shadow sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <!-- Logo -->
                <a href="/" class="text-2xl font-bold text-indigo-600 dark:text-indigo-400">
                    {{ config('app.name') }}
                </a>

                <!-- Theme Toggle -->
                <div class="flex items-center space-x-3">
                    <button id="theme-toggle-light" class="hidden p-2 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-700"
                        title="Light">
                        🌞
                    </button>
                    <button id="theme-toggle-dark" class="hidden p-2 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-700"
                        title="Dark">
                        🌙
                    </button>
                    <button id="theme-toggle-system"
                        class="hidden p-2 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-700" title="System">
                        💻
                    </button>
                </div>
            </div>

            <!-- Categories Nav -->
            <nav class="flex space-x-6 border-t border-gray-200 dark:border-gray-700 py-3 overflow-x-auto">
                <a href="/" class="hover:text-indigo-600 dark:hover:text-indigo-400">Home</a>
                <a href="/categories" class="hover:text-indigo-600 dark:hover:text-indigo-400">Category</a>
                <a href="/products" class="hover:text-indigo-600 dark:hover:text-indigo-400">Products</a>

                <a href="/category/sale" class="text-red-500 font-semibold">Deleted Products </a>
            </nav>
        </div>
    </header>
