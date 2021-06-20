<div class="bg-white rounded shadow overflow-hidden text-center">
    <div class="flex flex-col items-center space-y-4 relative px-6">
        <div class="bg-indigo-500 absolute top-0 left-0 right-0 py-10 z-0">
        </div>
        <div class="flex-shrink-0 mr-3 z-10">
            <img class="h-24 w-24 rounded-full border-2 border-indigo-300 object-cover"
                src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
        </div>

        <div class="z-10">
            <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
            <div class="font-medium text-sm text-gray-500">
                {{ Auth::user()->username }} ({{ Auth::user()->profession }})
            </div>
        </div>
    </div>
    <div class="grid grid-cols-2 gap-y-4 justify-between mt-6">
        <div class="font-medium text-base text-center text-gray-500">
            <div class="text-2xl font-bold">
                {{ Auth::user()->followers_count ?? 0 }}
            </div>
            <span>Followers</span>
        </div>
        <div class="font-medium text-base text-center text-gray-500">
            <div class="text-2xl font-bold">
                {{ Auth::user()->following_count ?? 0 }}
            </div>
            <span>Following</span>
        </div>
        <div class="font-medium text-base text-center text-gray-500">
            <div class="text-2xl font-bold">
                30
            </div>
            <span>Points</span>
        </div>
        <div class="font-medium text-base text-center text-gray-500">
            <div class="text-2xl font-bold">
                12
            </div>
            <span>Posts</span>
        </div>
    </div>
    <div class="py-6 px-6">
        @if(false)
        @csrf
        <x-jet-button>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
            </svg>
            {{ __('Follow') }}
        </x-jet-button>
        @else
        <x-jet-button x-data='' @click="window.location = '{{ route('profile.show') }}'">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
            </svg>
            {{ __('Edit Profile') }}
        </x-jet-button>
        @endif
    </div>
</div>