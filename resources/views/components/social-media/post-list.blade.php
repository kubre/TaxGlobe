<div>
    <x-common.news />

    <x-partials.grid responsiveLeft='true'>

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
            <div class="bg-white rounded-lg h-64 px-6 py-4">
                <h3 class="text-xl">Tax Calendar</h3>
            </div>
            <div class="h-64">
                <div class="bg-blue-200 flex flex-col justify-center items-center max-h-full">

                    <div class=" mx-auto relative" x-data="{ activeSlide: 1, slides: [1, 2, 3, 4, 5] }">
                        <!-- Slides -->
                        <template x-for="slide in slides" :key="slide">
                            <div x-show="activeSlide === slide"
                                class="p-24 font-bold text-4xl h-64 flex items-center bg-teal-500 text-white rounded-lg">
                                <span class="w-6 text-center" x-text="slide"></span>
                                <span class="text-teal-300">/</span>
                                <span class="w-6 text-center" x-text="slides.length"></span>
                            </div>
                        </template>

                        <!-- Buttons -->
                        <div class="absolute w-full flex items-center justify-center px-4">
                            <template x-for="slide in slides" :key="slide">
                                <button
                                    class="flex-1 w-4 h-2 mt-4 mx-2 mb-0 rounded-full overflow-hidden transition-colors duration-200 ease-out hover:bg-teal-600 hover:shadow-lg"
                                    :class="{  'bg-blue-600': activeSlide === slide, 'bg-blue-300': activeSlide !== slide }"
                                    x-on:click="activeSlide = slide"></button>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
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
