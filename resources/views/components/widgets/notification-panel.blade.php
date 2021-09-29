<div class="flex-col space-y-1 w-full items-start {{ $isDesktopOnly ? 'hidden lg:flex' : 'flex' }}">
    {{-- {{ $button ?? '' }} --}}
    {{-- <x-jet-secondary-button class="visible lg:hidden rounded-r-xl pr-3 py-2" :isRound="false" variant='warning'
            x-on:click="isOpen = !isOpen">
            <svg x-show="!isOpen" xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
            <svg x-show="isOpen" xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg> --}}
    {{-- </x-jet-secondary-button> --}}
    <div class="lg:bg-white lg:rounded-lg py-2 w-full px-4 lg:h-full lg:max-h-80 lg:h-80">

        <div class="flex justify-between">
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
                <strong>Notifications</strong>
            </div>
            @if ($notifications->isNotEmpty())
                <x-jet-secondary-button variant="white" class="mr-4" wire:click="deleteAll">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </x-jet-secondary-button>
            @endif
        </div>

        <div class="lg:mt-1 lg:max-h-64 lg:h-64">
            <div class="pt-2 h-full overflow-y-auto">
                @forelse ($notifications as $notif)
                    <a href="{{ $notif->action }}" class="py-1 px-2 bg-gray-300 rounded mb-1 cursor-pointer block">
                        <small class="bg-gray-100 rounded px-1">{{ $notif->time }}</small>
                        <span class="text-gray-700">{{ $notif->message }}</span>
                    </a>
                @empty
                    <div class="p-2">
                        {{ __('No new notifications') }}
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
