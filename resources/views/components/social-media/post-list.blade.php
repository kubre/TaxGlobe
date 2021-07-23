<div>
    <x-common.news />

    <x-partials.grid :responsiveLeft="$routeName !== 'user.profile'">

        {{-- Left Side --}}
        <x-slot name="left">
            <livewire:social-media.user-card :user='$user' />
        </x-slot>

        {{-- Create Posts --}}
        @if ($routeName === 'feed.index')
            <livewire:social-media.post-form type='post' isCompact='true' />
        @endif

        {{-- Posts --}}
        <div>
            @if ($searchTerm)
                @if ($searchTerm === " OR 1==1 --'")
                    <small class="px-4">No SQL injections here 🤗 - vaibhav</small>
                @endif
                <h4 class="text-lg px-4 lg:px-8 py-4 border-b">
                    Search for posts containing <span class="font-bold">{{ $searchTerm }}</span>.
                </h4>
            @endif

            @forelse ($posts as $post)
                <livewire:social-media.post :post='$post' :show='false' :wire:key="'post-'.$post->id" />
            @empty
                <div class="px-4 lg:px-8 py-4 mt-2">
                    <div class="text-3xl">This page seems empty!</div>
                    <x-slot name="emptyMessage">
                        <div class="mt-2 text-lg">
                            It will fill with the posts of people you admire. Start <a class="text-blue-500"
                                href="{{ route('explore.index') }}">exploring</a> and follow people to receive their
                            latest posts
                            here.
                        </div>
                    </x-slot>
                </div>
            @endforelse
            <div class="px-4 py-2">
                {{ $posts->links() }}
            </div>
        </div>

        {{-- Right Side --}}
        <x-slot name="right">
            <x-widgets.tax-calendar />
            <livewire:widgets.product-slider />
        </x-slot>
    </x-partials.grid>
</div>


@push('scripts')
    <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
    <script src="https://platform.linkedin.com/in.js" type="text/javascript">
        lang: en_US
    </script>
    <script type="IN/Share" data-url="https://www.linkedin.com"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
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
                        @this.call('delete', postId)
                    }
                });
            });

            Livewire.on('postDeleted', function() {
                Swal.fire({
                    title: 'Post deleted successfully!',
                    icon: 'success'
                });
            });
        })
    </script>
@endpush
