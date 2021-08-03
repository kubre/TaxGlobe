<a class="block flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800" href="{{ $route ?? '' }}">
    <div class="p-3 mr-4 rounded-full {{ $iconColors ?? '' }}">
        {{ $icon }}
    </div>
    <div>
        <p class="mb-2 text-sm font-medium text-gray-600">
            {{ $text }}
        </p>
        <p class="text-lg font-semibold text-gray-700">
            {{ number_shorten($value) }}
        </p>
    </div>
</a>
