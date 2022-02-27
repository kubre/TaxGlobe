<div>
    <x-common.news />
    <x-partials.grid>
        <div>
            <livewire:widgets.tax-calendar :fullPage="true" />
        </div>
        
        {{-- Right Side --}}
        <x-slot name="right">

            <livewire:widgets.product-slider />
        </x-slot>
    </x-partials.grid>
</div>
