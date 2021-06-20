<div {!! $attributes->merge(['class' => 'pb-12 pt-6 min-h-screen flex flex-col sm:justify-center items-center
    bg-gray-200']) !!}>
    <div>
        {{ $logo }}
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
</div>