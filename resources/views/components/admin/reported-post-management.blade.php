<div class="my-4">
    <x-slot name="title">
        <span class="text-red-500 bg-red-200 p-1 rounded">{{ __('Reported Posts Management') }}</span>
    </x-slot>
    <x-slot name="titleIcon">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
        </svg>
    </x-slot>
    <div>
        <livewire:tables.post-table :showOnlyReported="true" />
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded',
                function() {
                    Livewire.on('triggerDelete', function(postId) {
                        Swal.fire({
                            title: 'Are You Sure?',
                            text: 'You will not be able to recover this post again!',
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#aaa',
                            confirmButtonText: 'Delete!'
                        }).then((result) => {
                            if (result.value) {
                                @this.call('deletePost', postId)
                            }
                        });
                    });
                });
        </script>
    @endpush
</div>
