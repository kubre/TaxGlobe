<div class="flex flex-row items-center justify-between px-6 py-2 border-b border-gray-300">
    <a href="{{ route('user.profile', $user->id) }}" class="flex flex-row items-center">
        <div class="flex-shrink-0 mr-3 z-10">
            <img class="h-12 w-12 rounded-full border-2 border-indigo-300 object-cover"
                src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" />
        </div>

        <div>
            <div class="font-medium text-base text-gray-800">{{ $user->name }}
                @if (!is_null($user->profession))
                    <div class="text-gray-500 text-xs">({{ $user->profession }})</div>
                @endif
            </div>
        </div>
    </a>
    @if ($user->id !== auth()->id())
        <x-jet-button wire:click='follow'>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
            </svg>
            {{ Auth::user()->isFollowing($user) ? __('Unfollow') : __('Follow') }}
        </x-jet-button>
    @endif
</div>
