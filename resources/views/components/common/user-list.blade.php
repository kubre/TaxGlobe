<div>
    <x-common.news />
    <x-partials.grid>
        <x-slot name="left">
            <div>
                <div
                    class="flex-col space-y-0 md:space-y-2 mb-2 md:mb-0 {{ \in_array($currentRoute, ['user.profile', 'user.bookmarks']) ? 'flex' : 'hidden lg:flex' }}">
                    <livewire:social-media.user-card :user='$user' />
                    @auth
                        <x-partials.side-nav :routeUserId="optional(request()->route('user'))->id"
                            :routeName="$currentRoute" :userId="optional($user)->id"></x-partials.side-nav>
                    @endauth
                </div>
                <div>
                    @if (Auth::check() && Auth::id() === $user->id)
                        <livewire:widgets.notification-panel />
                    @endif
                </div>
            </div>
        </x-slot>

        {{-- Posts --}}
        <div>
            <div class="flex justify-between items-center">
                @if ($searchTerm)
                    @if ($searchTerm === " OR 1==1 --'")
                        <small class="px-4">No SQL injections here 🤗 - vaibhav</small>
                    @endif
                    <h3 class="text-lg px-4 py-2 border-b">
                        Results for users containing containing <span class="font-bold">{{ $searchTerm }}</span>.
                    </h3>
                    <x-widgets.share align="right"
                        whatsapp="Check out this product on taxglobe {{ route('users.index', ['q' => $searchTerm]) }}"
                        copy="{{ route('users.index', ['q' => $searchTerm]) }}">
                    </x-widgets.share>
                @else
                    @if ($currentRoute === 'users.suggestions')
                        <div class="flex text-lg px-4 space-x-2 items-center lg:px-8 py-4 border-b">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                            </svg>
                            <h4>
                                Discover new users to follow
                            </h4>
                        </div>
                    @endif
                @endif
            </div>

            @forelse ($users as $user)
                <livewire:common.user :user='$user' :wire:key="'user-'.$user->id" />
            @empty
                <div class="px-4 lg:px-8 py-4 mt-2">
                    <div class="text-3xl">This page seems empty!</div>
                    {{-- <div class="mt-2 text-lg">
                        It will fill with the posts of people you admire. Start <a class="text-blue-500"
                            href="{{ route('explore.index') }}">exploring</a> and follow people to receive their
                        latest posts
                        here.
                    </div> --}}
                </div>
            @endforelse
            <div class="px-4 py-2">
                {{ $users->links() }}
            </div>
        </div>

        {{-- Right Side --}}
        <x-slot name="right">
            <livewire:widgets.tax-calendar />
            <livewire:widgets.product-slider />
        </x-slot>
    </x-partials.grid>
</div>
