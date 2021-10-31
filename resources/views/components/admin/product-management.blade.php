<div class="my-4">
    <x-slot name="title">
        {{ __('Products Catalog') }}
    </x-slot>
    <x-slot name="titleIcon">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
        </svg>
    </x-slot>

    <div>
        <div x-data>
            {{-- <h4 class="text-lg font-bold">{{ __('Tax Calendar') }}</h4> --}}
            <x-jet-secondary-button @click="window.location = '{{ route('admin.products.form') }}'"
                variant="secondary">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>
                    {{ __('Add Product') }}
                </span>
            </x-jet-secondary-button>
        </div>

        <div class="mt-2">
            <livewire:tables.product-table />
        </div>
    </div>

    <div>
        {{-- <livewire:tables.post-table /> --}}
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded',
                function() {
                    Livewire.on('toggleHide', function(productId) {
                        Swal.fire({
                            title: 'Are You Sure?',
                            text: 'Are you sure you want toggle hide property?',
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#aaa',
                            confirmButtonText: 'Toggle!'
                        }).then((result) => {
                            if (result.value) {
                                @this.call('toggleHidden', productId)
                            }
                        });
                    });
                });
        </script>
    @endpush
</div>
