<div>
    <x-slot name="title">
        {{ __('Settings (Website Management)') }}
    </x-slot>
    <x-slot name="titleIcon">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewbox="0 0 24 24"
            stroke="currentcolor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
        </svg>
    </x-slot>
    {{-- basic info update section --}}
    <div class="my-4">
        <x-jet-form-section submit="updateBasicSettings">
            <x-slot name="title">
                {{ __('Basic information') }}
            </x-slot>

            <x-slot name="description">
                {{ __('Simple and basic settings of your webiste') }}
            </x-slot>

            <x-slot name="form">
                <div class="col-span6 sm:col-span-4">
                    <x-jet-validation-errors class="mb-4" />
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="banner" value="{{ __('News Banner') }}" />
                    <x-jet-input id="banner" class="block mt-1 w-full" type="text" name="banner"
                        wire:model.defer="settings.banner" />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="shipping_cost" value="{{ __('Current Shipping Cost') }}" />
                    <x-jet-input id="shipping_cost" class="block mt-1 w-full" type="text" name="shipping_cost"
                        wire:model.defer="settings.shipping_cost" />
                </div>
            </x-slot>
            <x-slot name="actions">
                <x-jet-action-message class="mr-3" on="saved">
                    {{ __('saved.') }}
                </x-jet-action-message>

                <x-jet-button>
                    {{ __('save') }}
                </x-jet-button>
            </x-slot>
        </x-jet-form-section>
    </div>
</div>
