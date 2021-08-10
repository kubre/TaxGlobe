<div wire:ignore x-data x-init="
    () => {
        const post = flatpickr($refs.{{ $attributes->get('ref') ?? 'input' }}, {
            enableTime: {{ $attributes->has('enableTime') ? 'true' : 'false' }},
            dateFormat: '{{ $attributes->get('dateFormat') ?? 'Y-m-d' }}',
            altInput: true,
            altFormat: '{{ $attributes->get('dateFormat') ?? 'F j, Y' }}',
            defaultDate: '{{ $attributes->get('defaultDate') ?? '' }}'
        });
    }
    ">
    <input type="date" {{ $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm']) }} x-ref="{{ $attributes->get('ref') ?? 'input' }}" />
</div>

@push('styles')
    @once
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    @endonce
@endpush

@push('scripts')
    @once
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    @endonce
@endpush
