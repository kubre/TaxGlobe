<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 rounded-full bg-indigo-200 text-indigo-700 border border-indigo-700 hover:bg-indigo-700 hover:text-indigo-100 font-semibold text-xs uppercase tracking-widest disabled:opacity-25 transition']) }}>
    {{ $slot }}
</button>