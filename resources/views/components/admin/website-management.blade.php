<div>
    <x-slot name="title">
        {{ __('Settings (Website Management)') }}
    </x-slot>
    <x-slot name="titleIcon">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
        </svg>
    </x-slot>
    <div class="my-4">
        <x-jet-form-section submit="updateBasicSettings">
            <x-slot name="title">
                {{ __('Basic Information') }}
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
            </x-slot>
            <x-slot name="actions">
                <x-jet-action-message class="mr-3" on="saved">
                    {{ __('Saved.') }}
                </x-jet-action-message>

                <x-jet-button wire:loading.attr="disabled" wire:target="photo">
                    {{ __('Save') }}
                </x-jet-button>
            </x-slot>
        </x-jet-form-section>
    </div>
</div>
