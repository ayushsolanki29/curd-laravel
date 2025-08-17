{{-- resources/views/components/toast.blade.php --}}
@if (session('success') || session('error'))
    <div 
        x-data="{ show: true }" 
        x-show="show" 
        x-transition 
        x-init="setTimeout(() => show = false, 4000)" 
        class="fixed top-5 right-5 z-50 max-w-sm w-full"
    >
        <div 
            class="flex items-start gap-3 rounded-lg shadow-lg p-4 border 
            {{ session('success') ? 'bg-green-50 border-green-300 text-green-800' : 'bg-red-50 border-red-300 text-red-800' }}"
        >
            {{-- Icon --}}
            @if (session('success'))
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
            @else
                <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd"
                        d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003zM12 8.25a.75.75 0 01.75.75v3.75a.75.75 0 01-1.5 0V9a.75.75 0 01.75-.75zm0 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z"
                        clip-rule="evenodd" />
                </svg>
            @endif

            {{-- Content --}}
            <div class="flex-1">
                <p class="font-medium">
                    {{ session('success') ? 'Success' : 'Error' }}
                </p>
                <p class="text-sm">
                    {{ session('success') ?? session('error') }}
                </p>
            </div>

            {{-- Close Button --}}
            <button 
                @click="show = false" 
                class="text-gray-400 hover:text-gray-600 transition"
            >
                ✕
            </button>
        </div>
    </div>
@endif
