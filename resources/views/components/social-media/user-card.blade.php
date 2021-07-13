<div class="bg-white rounded shadow overflow-hidden text-center">
    <div class="flex flex-col items-center space-y-4 relative px-6">
        <div class="bg-indigo-500 absolute top-0 left-0 right-0 py-10 z-0">
        </div>
        <div class="flex-shrink-0 mr-3 z-10">
            <img class="h-24 w-24 rounded-full border-2 border-indigo-300 object-cover"
                src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" />
        </div>

        <div class="z-10">
            <div class="font-medium text-base text-gray-800">{{ $user->name }}
                @if(!is_null($user->profession))
                    <div class="text-gray-500 text-sm">({{ $user->profession }})</div>
                @endif
            </div>
            @if(!is_null($user->bio))
                <div class="font-medium text-base text-gray-800 mt-1">
                    {{ $user->bio }}
                </div>
            @endif
        </div>
    </div>
    <div class="grid grid-cols-2 gap-y-4 justify-between mt-6">
        <div class="font-medium text-base text-center text-gray-500">
            <div class="text-2xl font-bold">
                {{ $followersCount }}
            </div>
            <span>Followers</span>
        </div>
        <div class="font-medium text-base text-center text-gray-500">
            <div class="text-2xl font-bold">
                {{ $followingsCount }}
            </div>
            <span>Following</span>
        </div>
        <div class="font-medium text-base text-center text-gray-500">
            <div class="text-2xl font-bold">
                {{ $user->points }}
            </div>
            <span>Points</span>
        </div>
        <div class="font-medium text-base text-center text-gray-500">
            <div class="text-2xl font-bold">
                {{ $postsCount }}
            </div>
            <span>Posts</span>
        </div>
    </div>
    @auth
        <div class="py-6 px-6">
        @if (Auth::id() == $user->id)
        <x-jet-button x-data='' @click="window.location = '{{ route('profile.show') }}'">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                </svg>
                {{ __('Edit Profile') }}
            </x-jet-button>
            
        @else
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
    @endauth
</div>
