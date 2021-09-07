<div class="my-4">
    <x-slot name="title">
        {{ __('Orders Management') }}
    </x-slot>
    <x-slot name="titleIcon">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
        </svg>
    </x-slot>

    <div>
        <div class="mt-2">
            <livewire:tables.order-table />
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded',
                function() {
                    Livewire.on('triggerUpdate', function(orderId) {
                        (async () => {
                            const {
                                value: status
                            } = await Swal.fire({
                                title: 'Updated status will be visible to the customer!',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#aaa',
                                confirmButtonText: 'Save',
                                input: 'select',
                                inputOptions: JSON.parse('{!! \json_encode(\App\Models\Order::$statusList) !!}'),
                                inputPlaceholder: 'Select a status',
                            });

                            if (status) {
                                @this.call('updateStatus', orderId, status)
                            }
                        })();
                    });
                });
        </script>
    @endpush
</div>
