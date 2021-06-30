<div x-data='{ open : false }'
    class="block sm:hidden fixed right-4 bottom-4 lg:right-8 lg:bottom-8 z-40">
    <div class="flex flex-col space-y-4 mb-4 z-40 origin-bottom" x-cloak
        x-show='open' x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0 transform scale-50"
        x-transition:enter-end="opacity-100 transform scale-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 transform scale-100"
        x-transition:leave-end="opacity-0 transform scale-50">

        <x-jet-secondary-button variant='success'
            @click="window.location = '{{ route('posts.form', \App\Models\Post::TYPE_ARTICLE) }}'"
            class=" py-4 lg:py-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-0 lg:mr-2"
                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="2"
                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
            </svg>
            <span class="hidden sm:inline-block">{{ __('Article') }}</span>
        </x-jet-secondary-button>
        <x-jet-button class="py-4 lg:py-2"
            @click="window.scrollTo({top: 0, behavior: 'smooth'}); open = !open">
            <svg class="h-5 w-5 mr-0 lg:mr-2" viewBox="0 0 24 24" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M16.3725 11.6213C17.9412 11.6213 19 12.7132 19 14.3309C19 15.7868 17.7843 17 16.1373 17C14.3333 17 13 15.5441 13 13.3199C13 8.26471 16.6863 6.24265 19 6L19 8.22426C17.4314 8.50735 15.6667 10.0846 15.5882 11.8235C15.6667 11.7831 15.9804 11.6213 16.3725 11.6213Z"
                    fill="currentColor"></path>
                <path
                    d="M8.37255 11.6213C9.94118 11.6213 11 12.7132 11 14.3309C11 15.7868 9.78431 17 8.13725 17C6.33333 17 5 15.5441 5 13.3199C5 8.26471 8.68627 6.24265 11 6V8.22426C9.43137 8.50735 7.66667 10.0846 7.58824 11.8235C7.66667 11.7831 7.98039 11.6213 8.37255 11.6213Z"
                    fill="currentColor"></path>
            </svg>
            <span class="hidden sm:inline-block">{{ __('Post') }}</span>
        </x-jet-button>
        <x-jet-secondary-button variant='warning' class="py-4 lg:py-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-0 lg:mr-2"
                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="2"
                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            <span class="hidden sm:inline-block text-cenetr">
                {{ __('Image') }}
            </span>
        </x-jet-secondary-button>
    </div>
    <x-jet-button x-on:click='open = !open'
        class="rounded-full pr-4 lg:pr-6 py-4 lg:py-2 bg-indigo-200 text-indigo-700 border border-indigo-700 hover:bg-indigo-700 hover:text-indigo-100">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-0 lg:mr-2"
            fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round"
                stroke-width="2"
                d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span class="hidden sm:inline-block">{{ __('Create') }}</span>
    </x-jet-button>
</div>