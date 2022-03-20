<div class="{{ $fullPage ? '' : '' }} py-4 bg-white mb-2 rounded-lg">

    {{-- Title --}}
    <div class="px-4 lg:px-8 py-2 flex items-center justify-between">
        <a href="{{ route('user.profile', $post->user_id) }}">
            <div class="flex items-center">
                <img class="h-8 w-8 rounded-full object-cover" src="{{ $post->user->profile_photo_url }}"
                    alt="{{ $post->user->name }}" />
                <div class="ml-3 flex flex-col w-48">
                    <span class="mr-1 font-bold text-sm truncate flex items-center">
                        {{ $post->user->name }}
                        @if($post->user->isAdmin())
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 ml-1 text-white rounded-full inline-block" fill="#6495ED" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                            </svg>
                        @endif
                    </span>
                    <span class="text-gray-500 text-xs truncate">
                            @if ($post->user->bio)
                                <span title="{{$post->user->bio}}">
                                    {{ Str::limit($post->user->bio ?? '', 30, $end = '...') }}
                                </span>
                            @endif
                    </span>
                </div>
            </div>
        </a>

        <div class="text-gray-500 text-xs flex items-center">
            {{ $post->created_at->format('d/m/y') }}
            @if ($post->updated_at->gt($post->created_at))
                <svg xmlns="http://www.w3.org/2000/svg" class="ml-1 h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
            @endif
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
                <div class="post-content" class="px-2 text-lg">
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
                <div class="w-full flex flex-col {{ $fullPage ? '' : 'bg-indigo-50 rounded-lg p-4' }}">
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

                        @php
                            $attachments = $post->getMedia('attachments');
                            $colors = ['red', 'green', 'blue'];
                        @endphp

                        @if ($attachments->isNotEmpty())
                            <hr class="bg-gray-300" />
                            <strong class="my-2 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                </svg>
                                Downloads
                            </strong>
                            <div class="flex items-center gap-2 flex-wrap">
                                @foreach ($attachments as $attachment)
                                    <a href="{{ route('article.image.download', $attachment->id) }}" target="_blank"
                                        class="px-4 py-2 bg-{{ $colors[$loop->index % 4] }}-200 text-{{ $colors[$loop->index % 4] }}-900 rounded-full flex items-center text-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                        </svg>
                                        {{ $attachment->name }}
                                    </a>
                                @endforeach
                            </div>
                        @endif
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
                                <span class="mt-4 flex items-center font-bold text-indigo-500 uppercase text-xs">
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
                    class="h-5 w-5 mr-1 {{ $hasLiked ? 'text-red-500 fill-current' : '' }}" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
            </x-jet-secondary-button>
            {{-- Comment --}}
            <x-jet-secondary-button wire:click="loadComments" variant='white'>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>
                <span class="text-base">
                    {{ number_shorten($post->comment_count) }}
                </span>
            </x-jet-secondary-button>

            <x-widgets.share align="left"
                whatsapp="Check out this post on taxglobe {{ route('post.show', $post->slug) }}"
                copy="{{ route('post.show', $post->slug) }}">
            </x-widgets.share>

            <x-jet-secondary-button class="cursor-default" variant='white'>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                <span class="text-base">
                    {{ number_shorten($post->view_count) }}
                </span>
            </x-jet-secondary-button>
        </div>
        <div class="flex space-x-2">
            @auth
                <x-jet-secondary-button variant="white" class="cursor-defaultu mr-auto" wire:click='toggleBookmark'>
                    {{-- Bookmark --}}
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 {{ $hasBookmarked ? 'text-indigo-700 fill-current' : '' }}" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                    </svg>
                </x-jet-secondary-button>
                <x-jet-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <x-jet-secondary-button variant='white'>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
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
                        <x-jet-dropdown-link class="flex items-center text-red-500"
                            wire:click="$emit('triggerReport', {{ $post->id }})">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            {{ __('Report Post') }}
                        </x-jet-dropdown-link>
                        @can('pin', \App\Models\Post::class)
                            <x-jet-dropdown-link class="flex items-center"
                                wire:click="$emit('triggerPin', '{{ $post->slug }}')">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path
                                        d="M13.1032 1.53098C9.91944 0.827342 8.15807 0.818684 5.06084 1.53098L4.30159 11.478C2.5835 11.9122 1.71398 12.5587 1 13.9648H7.77249L9.04233 23L10.9048 13.9648H17C16.481 12.6906 15.4807 12.1651 13.8677 11.478L13.1032 1.53098Z"
                                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                                </svg>
                                {{ __('Pin Post') }}
                            </x-jet-dropdown-link>
                        @endcan
                    </x-slot>
                </x-jet-dropdown>
            @endauth

        </div>
    </div>

    @if ($post->like_count)
        <div class="py-1 px-4 lg:px-8">
            <a @can('update', [App\Models\Post::class, $post])
                href="{{ route('users.likes', [
    'user' => auth()->id(),
    'post' => $post->slug,
]) }}" @endcan
                class="text-base">
                {{ number_shorten($post->like_count) }} like{{ $post->like_count === 1 ? '' : 's' }}
            </a>
        </div>
    @endif

    @if ($showComments || $fullPage)
        <div class="mt-2 pt-2 px-4 lg:px-8 border-t border-gray-300">
            @auth
                <form wire:submit.prevent="publishComment">
                    <div class="flex items-center gap-x-1">
                        <div class='flex-grow' x-data="{ comment: @entangle('commentDraft').defer }">
                            <textarea x-model='comment'
                                class="border-0 border-b focus:ring-0 focus:border-indigo-300 rounded-md shadow-sm w-full resize-none {{ $fullPage ? 'h-28' : 'h-11' }}"
                                x-bind:class='{ "ring ring-red-300 focus:ring focus:ring-red-300" : (comment && comment.length > 500) }'
                                name="commentDraft" id='commentDraft' placeholder='Write a comment'
                                wire:model.defer="commentDraft"></textarea>
                            <div class='-mt-8 mr-2 text-gray-500 text-right'
                                x-text='comment ? comment.length + "/500" : "0/500"'>
                            </div>
                        </div>
                        <div>
                            <x-jet-secondary-button wire:loading.attr="disabled" type='submit' variant='white'
                                class="pr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform rotate-90" fill="none"
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
            <div class="mt-4">
                @foreach ($comments as $comment)
                    <livewire:common.comment :comment='$comment' :wire:key="'comment-'.$post->id.'-'.$comment->id">
                    </livewire:common.comment>
                @endforeach
                {{ $comments->links('vendor.livewire.simple-tailwind') }}
            </div>
        </div>
    @else
        @if ($post->comments->isNotEmpty())
            <div class="mt-2 pt-2 px-4 lg:px-8 border-t border-gray-200">
                <livewire:common.comment :comment='$post->comments->first()' />
            </div>
        @endif
    @endif
</div>
