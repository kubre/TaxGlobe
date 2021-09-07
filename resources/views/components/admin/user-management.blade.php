<div>
    <x-slot name="title">
        {{ __('Users Management') }}
    </x-slot>
    <x-slot name="titleIcon">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
        </svg>
    </x-slot>
    <div class="my-4">
        <livewire:tables.user-table />
    </div>


    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded',
                function() {
                    Livewire.on('triggerDelete', function(userId) {
                        Swal.fire({
                            title: 'Are You Sure?',
                            text: 'You will not be able to recover this user again!',
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#aaa',
                            confirmButtonText: 'Delete!'
                        }).then((result) => {
                            if (result.value) {
                                @this.call('deleteUser', userId)
                            }
                        });
                    });
                });
        </script>
    @endpush
</div>
