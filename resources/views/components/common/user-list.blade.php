<div>
    <x-common.news />

    <x-partials.grid responsiveLeft='true'>

        {{-- Posts --}}
        <div>
            @if ($searchTerm)
                @if ($searchTerm === " OR 1==1 --'")
                    <small class="px-4">No SQL injections here too 🤗 - vaibhav</small>
                @endif
                <h4 class="text-lg px-4 lg:px-8 py-4 border-b">
                    Users with "<span class="font-bold">{{ $searchTerm }}</span>" in there name.
                </h4>
            @endif

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
            <x-widgets.tax-calendar />
            <livewire:widgets.product-slider />
        </x-slot>
    </x-partials.grid>
</div>
