<button
    {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center justify-center px-4 py-2 font-semibold text-xs text-white uppercase tracking-widest rounded-full bg-red-200 text-red-700 border border-red-700 hover:text-white hover:bg-red-700 disabled:opacity-25 transition']) }}>
    {{ $slot }}
</button>