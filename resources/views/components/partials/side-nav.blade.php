@props(['routeUserId', 'routeName', 'userId'])

@php
$validRoutes = ['user.profile', 'user.bookmarks', 'users.followers', 'users.followings'];
$showSideNav = \in_array($routeName, $validRoutes) && $routeUserId === auth()->id();
@endphp
<div
    class="grid grid-cols-3 md:grid-cols-1 bg-white rounded shadow overflow-hidden border-t md:border-none border-gray-300">
    @if ($showSideNav)
        <x-jet-responsive-nav-link href="{{ route('user.bookmarks', $userId) }}"
            :active="request()->routeIs('user.bookmarks')">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
            </svg>
            {{ __('Saved') }}
        </x-jet-responsive-nav-link>
        {{-- <x-jet-responsive-nav-link href="">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            {{ __('Orders') }}
        </x-jet-responsive-nav-link> --}}
    @endif
</div>
