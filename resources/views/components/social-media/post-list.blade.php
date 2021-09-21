<div>
    <x-common.news />

    @if ($fullPage)
        <x-slot name='head'>
            <meta property="og:title" content="{{ $posts->first()->title }}">
            <meta property="og:description" content="Read full on TaxGlobe.in">
            <meta property="og:image"
                content="{{ Storage::disk('posts')->url($posts->first()->image) ?? asset('images/logo.png') }}">
            <meta property="og:url" content="{{ route('post.show', $posts->first()->slug) }}">
            <meta name="twitter:card" content="summary_large_image">
            <meta property="og:site_name" content="TaxGlobe Professionals">
        </x-slot>
        <style>
            table,
            figure.table {
                width: 100%;
            }

            table,
            tr,
            td,
            th {
                padding: 4px;
                border: 1px solid;
                border-collapse: collapse;
            }

        </style>
    @endif

    <x-partials.grid :responsiveLeft="!\in_array($routeName, ['user.profile',  'user.bookmarks'])">

        {{-- Left Side --}}
        <x-slot name="left">
            <div class="flex flex-col space-y-0 md:space-y-2 mb-2 md:mb-0">
                <livewire:social-media.user-card :user='$user' />
                @auth
                    <x-partials.side-nav :routeUserId="optional(request()->route('user'))->id" :routeName="$routeName"
                        :userId="optional($user)->id"></x-partials.side-nav>
                @endauth
            </div>
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
                <livewire:social-media.post :post='$post' :show='false' :wire:key="'post-'.$post->id"
                    :fullPage="$fullPage" />
            @empty
                <div class="px-4 lg:px-8 py-4 mt-2">
                    <div class="text-3xl">This page seems empty!</div>
                    <div class="mt-2 text-lg">
                        It will fill with the posts of people you admire. Start <a class="text-blue-500"
                            href="{{ route('explore.index') }}">exploring</a> and follow people to receive their
                        latest posts
                        here.
                    </div>
                </div>
            @endforelse
            <div class="px-4 py-2">
                {{ $posts->links() }}
            </div>
        </div>

        {{-- Right Side --}}
        <x-slot name="right">
            @auth
                <livewire:widgets.notification-panel />
            @endauth
            <livewire:widgets.tax-calendar />
            <livewire:widgets.product-slider />
        </x-slot>
    </x-partials.grid>
</div>

@push('scripts')
    {{-- <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
    <script src="https://platform.linkedin.com/in.js" type="text/javascript">
        lang: en_US
    </script>
    <script type="IN/Share" data-url="https://www.linkedin.com"></script> --}}
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
        });
    </script>
@endpush
