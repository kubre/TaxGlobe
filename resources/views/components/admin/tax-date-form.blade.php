<div>
    <x-slot name="title">
        {{ __('Tax Date Form') }}
    </x-slot>
    <x-slot name="titleicon">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
        </svg>
    </x-slot>
    {{-- basic info update section --}}
    <div class="mt-4">
        <x-jet-form-section submit="save">
            <x-slot name="title">
                {{ __('Tax Date Form') }}
            </x-slot>

            <x-slot name="description">
                {{ __('Once added this will be visible on your website') }}
            </x-slot>

            <x-slot name="form">
                <div class="col-span6 sm:col-span-4">
                    <x-jet-validation-errors class="mb-4" />
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="title" value="{{ __('Title') }}" />
                    <x-jet-input id="title" class="block mt-1 w-full" type="text" name="title"
                        wire:model.defer="state.title" />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="description" value="{{ __('Description') }}" />
                    <textarea id="description"
                        class="block mt-1 w-full p-2 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                        type="text" name="description" wire:model.defer="state.description"></textarea>
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="date_at" value="{{ __('Date') }}" />
                    <x-common.datepicker id="date_at" class="block mt-1 w-full" name="date_at"
                        wire:model.defer="state.date_at" defaultDate="{{ $state['date_at'] ?? '' }}" />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="category" value="{{ __('Category') }}" />
                    <x-jet-input id="category" class="block mt-1 w-full" type="text" name="category" list="categories"
                        wire:model.defer="state.category" autocomplete="off" />
                    <datalist id="categories">
                        @foreach ($previousCategories as $category)
                            <option value="{{ $category }}">
                        @endforeach
                    </datalist>
                </div>
            </x-slot>
            <x-slot name="actions">
                <x-jet-action-message class="mr-3" on="saved">
                    {{ __('saved.') }}
                </x-jet-action-message>

                <x-jet-button wire:loading.attr="disabled" wire:target="photo">
                    {{ __('save') }}
                </x-jet-button>
            </x-slot>
        </x-jet-form-section>
    </div>
</div>
