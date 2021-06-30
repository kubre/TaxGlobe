<div class="text-center">
    @if ($paginator->hasPages())
        @if ($paginator->hasMorePages())
            <x-jet-secondary-button wire:click="nextPage" wire:loading.attr="disabled" rel="next">
                Load Next
            </x-jet-secondary-button>
        @endif
    @endif
</div>
