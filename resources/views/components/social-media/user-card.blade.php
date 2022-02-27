<div class="bg-white rounded-lg overflow-hidden text-center">
    @if (!is_null($user))
        <div class="flex flex-col items-center border-b border-gray-200 space-y-2 py-4 relative px-6">
            {{-- <div class="absolute top-0 left-0 right-0 py-10 z-0">
            </div> --}}
            <div class="flex flex-row items-center space-x-2 flex-shrink-0 mr-3 z-10">
                <img class="h-16 w-16 rounded-full border-2 border-indigo-200 object-cover"
                    src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" />
                <div class="flex flex-col">
                    <div class="font-bold text-base flex items-center">
                        <span class="flex-none">
                            {{ $user->name }}
                        </span>
                        @if($user->isAdmin())
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 ml-1 text-white rounded-full inline-block flex-none" fill="#6495ED" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                            </svg>
                        @endif
                    </div>
                    @auth
                        <div>
                            @if (!$showBasicInfoOnly)
                                @if (Auth::id() === $user->id)
                                    <x-jet-secondary-button variant='white' class="py-0 px-0" x-data=''
                                        @click="window.location = '{{ route('profile.show') }}'">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                        {{ __('Edit') }}
                                    </x-jet-secondary-button>
                                @else
                                    <x-jet-secondary-button variant='white' wire:click='follow'>
                                        @if (Auth::user()->isFollowing($user))
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13 7a4 4 0 11-8 0 4 4 0 018 0zM9 14a6 6 0 00-6 6v1h12v-1a6 6 0 00-6-6zM21 12h-6" />
                                            </svg>
                                            {{ __('Unfollow') }}
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                            </svg>
                                            {{ __('Follow') }}
                                        @endif
                                    </x-jet-secondary-button>
                                @endif
                            @endif
                        </div>
                    @endauth
                </div>
            </div>

            @if (!is_null($user->bio) && !$showBasicInfoOnly)
                <div class="text-sm mt-1">
                    {{ $user->bio }}
                </div>
            @endif
        </div>
        @if (!$showBasicInfoOnly)
            <div class="grid grid-cols-2 gap-y-4 justify-between py-4">
                <a href="{{ route('users.followers', $user->id) }}"
                    class="font-medium text-base text-center text-gray-500">
                    <div class="text-xl font-bold">
                        {{ number_shorten($followersCount) }}
                    </div>
                    <span>Followers</span>
                </a>
                <a href="{{ route('users.followings', $user->id) }}"
                    class="font-medium text-base text-center text-gray-500">
                    <div class="text-xl font-bold">
                        {{ number_shorten($followingsCount) }}
                    </div>
                    <span>Following</span>
                </a>
                <div class="font-medium text-base text-center text-gray-500">
                    <div class="text-xl font-bold">
                        {{ number_shorten($user->points) }}
                    </div>
                    <span>Points</span>
                </div>
                <a href="{{ route('user.profile', $user->id) }}"
                    class="font-medium text-base text-center text-gray-500">
                    <div class="text-xl font-bold">
                        {{ number_shorten($postsCount) }}
                    </div>
                    <span>Posts</span>
                </a>
            </div>
        @endif
    @endif
</div>
