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

    <x-partials.grid bg="gray-100">

        {{-- Left Side --}}
        <x-slot name="left">
            <div>
                <div
                    class="flex-col space-y-0 md:space-y-2 mb-2 md:mb-0 {{ \in_array($routeName, ['user.profile', 'user.bookmarks']) ? 'flex' : 'hidden lg:flex' }}">
                    <livewire:social-media.user-card :user='$user' />
                    @auth
                        <x-partials.side-nav :routeUserId="optional(request()->route('user'))->id" :routeName="$routeName"
                            :userId="optional($user)->id"></x-partials.side-nav>
                    @endauth
                </div>
                <div>
                    @if (Auth::check() && Auth::id() === $user->id)
                        <livewire:widgets.notification-panel />
                    @endif
                </div>
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

            @if (\in_array($routeName, ['explore.index', 'feed.index']) && $pinnedPosts->isNotEmpty())
                <div class="bg-gray-200 p-2 rounded-lg mb-2" x-data="{open: true}">
                    <div class="flex items-center" x-on:click="open = !open">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path
                                d="M13.1032 1.53098C9.91944 0.827342 8.15807 0.818684 5.06084 1.53098L4.30159 11.478C2.5835 11.9122 1.71398 12.5587 1 13.9648H7.77249L9.04233 23L10.9048 13.9648H17C16.481 12.6906 15.4807 12.1651 13.8677 11.478L13.1032 1.53098Z"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                        </svg>
                        <span>
                            <span>Posts pinned by Administrator</span>
                            <span class='underline cursor-pointer' x-text="open ? 'Hide' : 'Show'"></span>
                        </span>
                    </div>
                    <div class="relative overflow-hidden max-h-0 transition-all duration-500 grid grid-cols-1 md:grid-cols-2 gap-x-2 gap-y-2 pt-1"
                        x-ref="pinned" x-bind:style=" open ? 'max-height: ' + $refs.pinned.scrollHeight + 'px' : ''">
                        @foreach ($pinnedPosts as $slug => $title)
                            <div class="bg-white rounded-lg p-2 flex items-center">
                                <a class="flex items-center gap-x-2 flex-grow" href="{{ route('post.show', $slug) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-none" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                                    </svg>
                                    <span>{{ Str::words($title, 6) }}</span>
                                </a>
                                @can('pin', \App\Models\Post::class)
                                    <span wire:click="deletePin('{{ $slug }}')"
                                        class="flex-none px-2 cursor-pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </span>
                                @endcan
                            </div>
                        @endforeach
                    </div>
                </div>
            @else

            @endif

            @forelse ($posts as $post)
                <livewire:social-media.post :post='$post' :show='false' :wire:key="'post-'.$post->id"
                    :fullPage="$fullPage" />
                @if ($loop->iteration === 6 || $loop->iteration === 15)
                    @mobile
                    <livewire:widgets.product-slider />
                    @endmobile
                @endif
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
            @if ($posts->hasMorePages())
                <div class="px-4 py-2 flex justify-center items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 animate-spin" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    <span>
                        Loading More
                    </span>
                    {{-- {{ $posts->links('vendor.livewire.simple-tailwind') }} --}}
                </div>
            @endif
            <input type="hidden" id="hasMorePages" value="{{ (bool) $posts->hasMorePages() }}" />
        </div>

        {{-- Right Side --}}
        <x-slot name="right">
            <livewire:widgets.tax-calendar />
            @desktop
            <livewire:widgets.product-slider />
            @enddesktop
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
            
            var contents = document.getElementsByClassName("post-content");

            for (var content of contents) {
                console.log(typeof content.innerHTML)
                if (!content.innerHTML.includes("javascript:")) {
                    content.innerHTML = content.innerHTML.replace(/(https?:\/\/[^\s]+)/g, "<a href='$1' class='text-blue-700 underline' target='_blank'>$1</a>");
                }
            }

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

            Livewire.on('triggerPin', function(postSlug) {
                (async () => {
                    const {
                        value: pinTitle
                    } = await Swal.fire({
                        title: 'Pin this post',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#aaa',
                        confirmButtonText: 'Pin',
                        input: 'text',
                        inputPlaceholder: 'Add a Title',
                    });

                    if (pinTitle) {
                        @this.call('pin', postSlug, pinTitle)
                    }
                })();
            });

            Livewire.on('triggerReport', function(postId) {
                (async () => {
                    const {
                        value: reason
                    } = await Swal.fire({
                        title: 'Please state the reason to report this post?',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#aaa',
                        confirmButtonText: 'Report',
                        input: 'select',
                        inputOptions: JSON.parse('{!! \json_encode(\App\Models\Post::$reportReasons) !!}'),
                        inputPlaceholder: 'Select a reason',
                    });

                    if (reason) {
                        @this.call('reportPost', postId, reason)
                    }
                })();
            });

            Livewire.on('postDeleted', function() {
                Swal.fire({
                    title: 'Post deleted successfully!',
                    icon: 'success'
                });
            });

            Livewire.on('postPinned', function() {
                Swal.fire({
                    title: 'Toggled pin status of post.',
                    icon: 'success'
                });
            });

            Livewire.on('postReported', function() {
                Swal.fire({
                    title: 'Post has been reported successfully!',
                    icon: 'success'
                });
            });

            var hasWaitedEnoughToScroll = true;
            window.onscroll = function(ev) {
                setTimeout(function() {
                    hasWaitedEnoughToScroll = true;
                }, 5000);
                if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight - 50 &&
                    hasWaitedEnoughToScroll && (document.getElementById('hasMorePages').value ===
                        '1')) {
                    hasWaitedEnoughToScroll = false;
                    @this.call('loadMore');
                }
            };
        });
    </script>
@endpush
