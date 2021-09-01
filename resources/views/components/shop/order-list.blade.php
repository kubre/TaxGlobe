<div>
    <x-common.news />
    <x-partials.grid :responsiveLeft='false'>
        <x-slot name="left">
            <div class="flex flex-col space-y-0 md:space-y-2 mb-2 md:mb-0">
                <livewire:social-media.user-card :user='$user' />
                <x-partials.side-nav :routeUserId="auth()->id()" routeName="shop.order.list" :userId="$user->id" />
            </div>
        </x-slot>

        {{-- Posts --}}
        <div>
            <div class="my-2">
                <h3 class="text-lg px-4 py-2 border-b">
                    Purchases
                </h3>
            </div>

            @forelse ($orders as $order)
                <livewire:shop.order :order="$order" />
            @empty
                <div class="px-4 lg:px-8 py-4 mt-2">
                    <div class="text-3xl">This page seems empty!</div>
                </div>
            @endforelse
            <div class="px-4 py-2">
                {{ $orders->links() }}
            </div>
        </div>

        {{-- Right Side --}}
        <x-slot name="right">
            <livewire:widgets.tax-calendar />
            <livewire:widgets.product-slider />
        </x-slot>
    </x-partials.grid>
</div>
