<div class="{{ $fullPage ? '' : 'border-b border-gray-300' }} py-4">

    {{-- Title --}}
    <div class="px-4 lg:px-8 py-2 flex items-center justify-between">
        <a href="{{ route('user.profile', $post->user_id) }}">
            <div class="flex items-center">
                <img class="h-8 w-8 rounded-full object-cover" src="{{ $post->user->profile_photo_url }}"
                    alt="{{ $post->user->name }}" />
                <div class="ml-3 flex flex-col w-48">
                    <span class="mr-1 font-bold text-sm truncate">
                        {{ $post->user->name }}
                    </span>
                    <span class="text-gray-500 text-xs truncate">
                        {{ $post->user->bio ?? '' }}
                    </span>
                </div>
            </div>
        </a>

        <div class="text-gray-500 text-xs">
            {{ $post->created_at->format('d/m/y') }}
            {{ $post->updated_at->gt($post->created_at) ? '(edited)' : '' }}
        </div>
    </div>

    {{-- Post Cotent --}}
    <div class="my-2">
        @if ($post->type === 'post')
            <div class="max-w-full w-full flex mx-auto px-4 lg:px-8">
                <svg class="h-5 w-5 flex-none" viewBox="0 0 24 24" fill="currentColor"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M16.3725 11.6213C17.9412 11.6213 19 12.7132 19 14.3309C19 15.7868 17.7843 17 16.1373 17C14.3333 17 13 15.5441 13 13.3199C13 8.26471 16.6863 6.24265 19 6L19 8.22426C17.4314 8.50735 15.6667 10.0846 15.5882 11.8235C15.6667 11.7831 15.9804 11.6213 16.3725 11.6213Z"
                        fill="#2E3A59"></path>
                    <path
                        d="M8.37255 11.6213C9.94118 11.6213 11 12.7132 11 14.3309C11 15.7868 9.78431 17 8.13725 17C6.33333 17 5 15.5441 5 13.3199C5 8.26471 8.68627 6.24265 11 6V8.22426C9.43137 8.50735 7.66667 10.0846 7.58824 11.8235C7.66667 11.7831 7.98039 11.6213 8.37255 11.6213Z"
                        fill="#2E3A59"></path>
                </svg>
                <div class="px-2 text-lg">
                    {!! nl2br(e($post->title)) !!}
                </div>
            </div>
        @elseif($post->type === 'image')
            <div class="flex flex-col space-y-2 justify-center h-auto w-100 px-0 lg:px-8">
                <span class="text-gray-500 px-4">{{ $post->title }}</span>
                <img onclick="openImage('{{ Storage::disk('posts')->url($post->image) }}')"
                    class="object-cover rounded-none lg:rounded" style="max-height: 80vh"
                    src="{{ Storage::disk('posts')->url($post->image) }}">
            </div>
        @elseif($post->type === 'article')
            <div class="px-4 lg:px-8 pb-2">
                <div class="w-full flex flex-col {{ $fullPage ? '' : 'border border-gray-300 rounded-lg p-4' }}">
                    @if ($fullPage)
                        <hr>
                        @if ($post->image)
                            <img onclick="openImage('{{ Storage::disk('posts')->url($post->image) }}')"
                                class="object-cover rounded-none lg:rounded w-full max-w-full"
                                src="{{ Storage::disk('posts')->url($post->image) }}">
                        @endif
                        <h3 class="font-bold text-2xl mt-4">{{ $post->title }}</h3>

                        <div class="mt-4">
                            {!! $post->body !!}
                        </div>
                    @else
                        <a href="{{ route('post.show', $post->slug) }}">
                            <div class="flex flex-col space-y-2">
                                <h4 class="font-bold w-full text-base overflow-hidden" style="max-height: 3.4em;">
                                    {{ $post->title }}
                                </h4>
                                @if ($post->image)
                                    <img class="object-cover rounded-none lg:rounded w-full" style="max-height: 200px"
                                        src="{{ Storage::disk('posts')->url($post->image) }}">
                                @endif
                                <span class="mt-4 flex items-center font-bold text-blue-500 uppercase text-xs">
                                    Click to continue reading
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                </span>
                            </div>
                        </a>
                    @endif
                </div>
            </div>
        @endif
    </div>

    {{-- @todo Tags --}}
    {{-- <div class="flex space-x-2 flex-wrap px-4 lg:px-8 pt-2">
        <a href=""
            class="bg-gray-100 rounded-full px-2 text-gray-700 hover:text-white hover:bg-gray-700 transition border border-gray-700">#work</a>
        <a href=""
            class="bg-gray-100 rounded-full px-2 text-gray-700 hover:text-white hover:bg-gray-700 transition border border-gray-700">#tax</a>
        <a href=""
            class="bg-gray-100 rounded-full px-2 text-gray-700 hover:text-white hover:bg-gray-700 transition border border-gray-700">#ca</a>
    </div> --}}

    {{-- Bootom Bar --}}
    <div class="flex justify-between px-4 lg:px-8 mt-2">
        <div class="flex space-x-1">
            {{-- Like --}}
            <x-jet-secondary-button wire:click="toggleLike" variant='white'>
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6 mr-1 {{ $hasLiked ? 'text-red-500 fill-current' : '' }}" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
                <span class="text-base">
                    {{ number_shorten($post->like_count) }}
                </span>
            </x-jet-secondary-button>
            {{-- Comment --}}
            <x-jet-secondary-button wire:click="loadComments" variant='white'>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-1" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>
                <span class="text-base">
                    {{ number_shorten($post->comment_count) }}
                </span>
            </x-jet-secondary-button>
            <x-jet-secondary-button class="cursor-default" variant='white'>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-1" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                <span class="text-base">
                    {{ number_shorten($post->view_count) }}
                </span>
            </x-jet-secondary-button>
            <x-jet-dropdown align="left" width="48">
                <x-slot name="trigger">
                    <x-jet-secondary-button variant='white'>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                        </svg>
                    </x-jet-secondary-button>
                </x-slot>

                <x-slot name="content">
                    {{-- <x-jet-dropdown-link class="flex items-center" target='_blank'
                        href="https://www.facebook.com/sharer/sharer.php?u={{ route('post.show', $post->slug) }}">
                        <svg fill="#1877F2" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            class="w-4 h-4 mr-2" viewBox="0 0 24 24">
                            <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z">
                            </path>
                        </svg>
                        {{ __('Facebook') }}
                    </x-jet-dropdown-link>
                    <x-jet-dropdown-link
                        href="https://twitter.com/share?ref_src={{ route('post.show', $post->slug) }}"
                        target='_blank' class="flex items-center twitter-share-button" data-show-count="true">
                        <svg fill="#1DA1F2" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            class="w-4 h-4 mr-2" viewBox="0 0 24 24">
                            <path
                                d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z">
                            </path>
                        </svg>
                        {{ __('Twitter') }}
                    </x-jet-dropdown-link>
                    <x-jet-dropdown-link class="flex items-center" target="_blank"
                        href="https://www.linkedin.com/sharing/share-offsite/?url={{ route('post.show', $post->slug) }}">
                        <svg fill="#0A66C2" stroke=" currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="0" class="w-4 h-4 mr-2" viewBox="0 0 24 24">
                            <path stroke="none"
                                d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z">
                            </path>
                            <circle cx="4" cy="4" r="2" stroke="none"></circle>
                        </svg>
                        {{ __('Linked In') }}
                    </x-jet-dropdown-link> --}}
                    <x-jet-dropdown-link class="flex items-center"
                        href="https://api.whatsapp.com/send?text={{ route('post.show', $post->slug) }}"
                        target="_blank">
                        <svg fill="#25D366" class="h-4 w-4 mr-2" role="img" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                        </svg>
                        {{ __('Whatsapp') }}
                    </x-jet-dropdown-link>
                    <x-jet-dropdown-link data-clipboard-text="{{ route('post.show', $post->slug) }}"
                        class="flex items-center copy-link">
                        <svg class="h-4 w-4 mr-2" role="img" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                        </svg>
                        {{ __('Copy Link') }}
                    </x-jet-dropdown-link>
                </x-slot>
            </x-jet-dropdown>
        </div>
        <div class="flex space-x-2">
            {{-- Bookmark --}}
            @auth
                <x-jet-secondary-button variant='white' wire:click='toggleBookmark'>
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 {{ $hasBookmarked ? 'text-blue-900 fill-current' : '' }}" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                    </svg>
                </x-jet-secondary-button>
            @endauth
            <x-jet-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <x-jet-secondary-button variant='white'>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" />
                        </svg>
                    </x-jet-secondary-button>
                </x-slot>

                <x-slot name="content">
                    @can('update', $post)
                        <x-jet-dropdown-link class="flex items-center"
                            href="{{ route('posts.form', ['post' => $post->id, 'type' => $post->type]) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                            </svg>
                            {{ __('Edit') }}
                        </x-jet-dropdown-link>
                    @endcan
                    @can('delete', $post)
                        <x-jet-dropdown-link class="flex items-center"
                            wire:click="$emit('triggerDelete', {{ $post->id }})">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            {{ __('Delete') }}
                        </x-jet-dropdown-link>
                    @endcan
                    <x-jet-dropdown-link class="flex items-center text-red-500" href="{{ route('profile.show') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        {{ __('Report Post') }}
                    </x-jet-dropdown-link>
                </x-slot>
            </x-jet-dropdown>
        </div>
    </div>

    @if ($showComments || $fullPage)
        <div class="mt-2 px-4 lg:px-8 ">
            @auth
                <form wire:submit.prevent="publishComment">
                    <div class="flex items-center space-x-1">
                        <div class='flex-grow' x-data="{ comment: @entangle('commentDraft').defer }">
                            <textarea x-model='comment'
                                class="border-gray-300 focus:border-indigo-300 rounded-md shadow-sm w-full resize-none {{ $fullPage ? 'h-28' : 'h-11' }}"
                                x-bind:class='{ "ring ring-red-300 focus:ring focus:ring-red-300" : (comment && comment.length > 500) }'
                                name="commentDraft" id='commentDraft' placeholder='Write a comment'
                                wire:model.defer="commentDraft"></textarea>
                            <div class='-mt-8 mr-2 text-gray-500 text-right'
                                x-text='comment ? comment.length + "/500" : "0/500"'>
                            </div>
                        </div>
                        <div>
                            <x-jet-secondary-button wire:loading.attr="disabled" type='submit' variant='white' class="pr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 transform rotate-90" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                </svg>
                            </x-jet-secondary-button>
                        </div>
                    </div>
                    @error('commentDraft')
                        <div class="text-red-500 text-sm mt-1">Comment is requried and should be less than 500 characters.</div>
                    @enderror
                </form>
            @endauth
            <div class="mt-2">
                @foreach ($comments as $comment)
                    <livewire:common.comment :comment='$comment' :wire:key="'comment-'.$post->id.'-'.$comment->id" />
                @endforeach
                {{ $comments->links('components.common.load-more') }}
            </div>
        </div>
    @else
        @if ($post->comments->isNotEmpty())
            <div class="mt-2 px-4 lg:px-8 ">
                <livewire:common.comment :comment='$post->comments->first()' />
            </div>
        @endif
    @endif
</div>
