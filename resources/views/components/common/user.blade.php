<div class="flex flex-row items-center justify-between px-6 py-2 border-b border-gray-300">
    <a href="{{ route('user.profile', $user->id) }}" class="flex flex-row items-center">
        <div class="flex-shrink-0 mr-3 z-10">
            <img class="h-12 w-12 rounded-full border-2 border-indigo-300 object-cover"
                src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" />
        </div>

        <div>
            <div class="font-medium text-base text-gray-800">
                <div class="flex items-center">
                    {{ $user->name }}
                    @if($user->isAdmin())
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 ml-1 text-white rounded-full inline-block flex-none" fill="#6495ED" viewBox="0 0 24 24" stroke="currentColor" title="Administrator">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                            </svg>
                        @endif
                </div>
                <div class="text-gray-500 text-xs">
                    @if (!is_null($user->bio))
                    {{ $user->bio }}
                    @endif
                </div>
            </div>
        </div>
    </a>
    @if ($user->id !== auth()->id())
        <x-jet-button wire:click='follow'>
            @if (Auth::user()->isFollowing($user))
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-0 lg:mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 7a4 4 0 11-8 0 4 4 0 018 0zM9 14a6 6 0 00-6 6v1h12v-1a6 6 0 00-6-6zM21 12h-6" />
                </svg>
                <span class="hidden lg:inline-block">{{ __('Unfollow') }}</span> 
            @else
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-0 lg:mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                </svg>
                <span class="hidden lg:inline-block">{{ __('Follow') }}</span> 
            @endif
        </x-jet-button>
    @endif
</div>
