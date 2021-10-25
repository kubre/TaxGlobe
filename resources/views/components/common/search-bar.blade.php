<div class="relative w-full" x-data="{ term: @entangle('term').defer }">
    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
    </span>

    <input type="text" x-model='term' wire:model.defer='term' wire:keydown.enter='searchPosts' maxlength="50"
        class="w-full py-2 pl-10 pr-4 text-gray-700 bg-indigo-100 rounded-lg focus:bg-indigo-200 
        focus:w-1/2 focus:ring-0 border-0 border-b-2 border-indigo-200 transition placeholder-gray-700"
        placeholder="Search">
    <div x-cloak x-show='term && term.length > 2'
        class="absolute top-10.5 bg-gray-50 shadow-lg rounded-lg w-full p-2 z-50">
        <div wire:click="searchPosts"
            class="p-2 flex gap-y-1 flex-col overlfow-hidden w-full cursor-pointer hover:bg-gray-200 rounded">
            <span class="font-bold">Search in Posts: </span><span x-text="term"></span>
        </div>
        <div wire:click="searchProducts"
            class="p-2 flex gap-y-1 flex-col overlfow-hidden w-full cursor-pointer hover:bg-gray-200 rounded">
            <span class="font-bold">Search in Products: </span><span x-text="term"></span>
        </div>
        @auth
            <div wire:click="searchUsers"
                class="p-2 flex gap-y-1 flex-col overlfow-hidden w-full cursor-pointer hover:bg-gray-200 rounded">
                <span class="font-bold">Search in Profiles: </span><span x-text="term"></span>
            </div>
        @endauth
        @guest
            <div class="p-2 overlfow-hidden w-full text-gray-500 rounded">
                Login to search profiles
            </div>
        @endguest
    </div>
</div>
