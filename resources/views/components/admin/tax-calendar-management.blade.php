<div>
    <x-slot name="title">
        {{ __('Tax Calendar Management') }}
    </x-slot>
    <x-slot name="titleIcon">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 " fill="none" viewbox="0 0 24 24"
            stroke="currentcolor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
        </svg>
    </x-slot>

    {{-- Tax Calendar --}}
    <div class="my-4">
        <div x-data>
            {{-- <h4 class="text-lg font-bold">{{ __('Tax Calendar') }}</h4> --}}
            <x-jet-secondary-button @click="window.location = '{{ route('admin.tax-date.edit') }}'"
                variant="secondary">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>
                    {{ __('Add Date') }}
                </span>
            </x-jet-secondary-button>
        </div>
    </div>

    <div class="my-4">
        <livewire:tables.tax-date-table />
    </div>


    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded',
            function() {
                Livewire.on('triggerDelete', function(taxDateId) {
                    Swal.fire({
                        title: 'Are You Sure?',
                        text: 'You will not be able to recover this record again!',
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#aaa',
                        confirmButtonText: 'Delete!'
                    }).then((result) => {
                        if (result.value) {
                            @this.call('deleteDate', taxDateId)
                        }
                    });
                });

                Livewire.on('dateDeleted', function() {
                    Swal.fire({
                        title: 'Date removed successfully!',
                        icon: 'success'
                    });
                });
            });
    </script>
@endpush
</div>
