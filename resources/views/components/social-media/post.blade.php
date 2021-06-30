<div class="border-b border-gray-300 py-4">

    {{-- Title --}}
    <div class="px-4 lg:px-8 py-2 flex items-center justify-between">
        <div class="flex items-center">
            <img class="h-8 w-8 rounded-full object-cover"
                src="{{ $post->user->profile_photo_url }}"
                alt="{{ $post->user->name }}" />
            <div class="ml-3">
                <span class="font-bold mr-1">{{ $post->user->name }}</span>
                <span class="text-gray-500 text-xs">
                    ({{ $post->user->profession }})
                </span>
            </div>
        </div>
        <div class="text-gray-500 text-sm">
            {{ $post->created_at->diffForHumans() }}
        </div>
    </div>

    {{-- Post Cotent --}}
    <div class="my-2">
        @if($post->type === 'post')
        <div class="max-w-lg flex mx-auto px-4 lg:px-0">
            <svg class="h-5 w-5 flex-none" viewBox="0 0 24 24"
                fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M16.3725 11.6213C17.9412 11.6213 19 12.7132 19 14.3309C19 15.7868 17.7843 17 16.1373 17C14.3333 17 13 15.5441 13 13.3199C13 8.26471 16.6863 6.24265 19 6L19 8.22426C17.4314 8.50735 15.6667 10.0846 15.5882 11.8235C15.6667 11.7831 15.9804 11.6213 16.3725 11.6213Z"
                    fill="#2E3A59"></path>
                <path
                    d="M8.37255 11.6213C9.94118 11.6213 11 12.7132 11 14.3309C11 15.7868 9.78431 17 8.13725 17C6.33333 17 5 15.5441 5 13.3199C5 8.26471 8.68627 6.24265 11 6V8.22426C9.43137 8.50735 7.66667 10.0846 7.58824 11.8235C7.66667 11.7831 7.98039 11.6213 8.37255 11.6213Z"
                    fill="#2E3A59"></path>
            </svg>
            <div class="px-2 text-lg">
                {{ $post->title }}
            </div>
        </div>
        @elseif($post->type === 'image')
        <div class="flex justify-center h-auto w-100 px-0 lg:px-8">
            <img class="object-cover rounded-none lg:rounded"
                src="https://images.unsplash.com/photo-1624037576929-c24689f88ae3?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=640&h=640&q=80">
        </div>
        @elseif($post->type === 'article')
        <div class="px-4 lg:px-8 pb-2">
            <a href="" class="flex justify-center max-w-full">
                <div
                    class="w-full border flex flex-col border-gray-300 rounded-lg p-4">
                    <h4 class="font-bold truncate">{{ $post->title }}</h4>
                    <div class="mt-2 w-full truncate">
                        {!! $post->body !!}
                    </div>
                    <div
                        class="mt-4 flex items-center font-bold text-blue-500 uppercase text-xs">
                        Click to continue reading
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                </div>
            </a>
        </div>
        @endif
    </div>

    <div class="flex space-x-2 flex-wrap px-4 lg:px-8 pt-2">
        <a href=""
            class="bg-gray-100 rounded-full px-2 text-gray-700 hover:text-white hover:bg-gray-700 transition border border-gray-700">#work</a>
        <a href=""
            class="bg-gray-100 rounded-full px-2 text-gray-700 hover:text-white hover:bg-gray-700 transition border border-gray-700">#tax</a>
        <a href=""
            class="bg-gray-100 rounded-full px-2 text-gray-700 hover:text-white hover:bg-gray-700 transition border border-gray-700">#ca</a>
    </div>

    {{-- Bootom Bar --}}
    <div class="flex justify-between px-4 lg:px-8 mt-2">
        <div class="flex space-x-2">
            <x-jet-secondary-button variant='white'>
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6 text-red-500 fill-current" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2"
                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
            </x-jet-secondary-button>
            <x-jet-secondary-button variant='white'>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2"
                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>
            </x-jet-secondary-button>
            <x-jet-dropdown align="left" width="48">
                <x-slot name="trigger">
                    <x-jet-secondary-button variant='white'>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                            fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                        </svg>
                    </x-jet-secondary-button>
                </x-slot>

                <x-slot name="content">
                    <x-jet-dropdown-link class="flex items-center"
                        href="{{ route('profile.show') }}">
                        <svg fill="#1877F2" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2"
                            class="w-4 h-4 mr-2" viewBox="0 0 24 24">
                            <path
                                d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z">
                            </path>
                        </svg>
                        {{ __('Facebook') }}
                    </x-jet-dropdown-link>
                    <x-jet-dropdown-link class="flex items-center"
                        href="{{ route('profile.show') }}">
                        <svg fill="#1DA1F2" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2"
                            class="w-4 h-4 mr-2" viewBox="0 0 24 24">
                            <path
                                d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z">
                            </path>
                        </svg>
                        {{ __('Twitter') }}
                    </x-jet-dropdown-link>
                    <x-jet-dropdown-link class="flex items-center"
                        href="{{ route('profile.show') }}">
                        <svg fill="#0A66C2  " stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="0" class="w-4 h-4 mr-2"
                            viewBox="0 0 24 24">
                            <path stroke="none"
                                d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z">
                            </path>
                            <circle cx="4" cy="4" r="2" stroke="none"></circle>
                        </svg>
                        {{ __('Linked In') }}
                    </x-jet-dropdown-link>
                    <x-jet-dropdown-link class="flex items-center"
                        href="{{ route('profile.show') }}">
                        <svg fill="#25D366" class="h-4 w-4 mr-2" role="img"
                            viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                        </svg>
                        {{ __('Whatsapp') }}
                    </x-jet-dropdown-link>
                </x-slot>
            </x-jet-dropdown>
        </div>
        <div class="flex space-x-2">
            <x-jet-secondary-button variant='white'>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2"
                        d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                </svg>
            </x-jet-secondary-button>
            <x-jet-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <x-jet-secondary-button variant='white'>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                            fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" />
                        </svg>
                    </x-jet-secondary-button>
                </x-slot>

                <x-slot name="content">
                    <x-jet-dropdown-link class="flex items-center text-red-500"
                        href="{{ route('profile.show') }}">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        {{ __('Report Post') }}
                    </x-jet-dropdown-link>
                    <x-jet-dropdown-link class="flex items-center"
                        href="{{ route('profile.show') }}">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ __('Go to Profile') }}
                    </x-jet-dropdown-link>
                </x-slot>
            </x-jet-dropdown>
        </div>
    </div>
</div>