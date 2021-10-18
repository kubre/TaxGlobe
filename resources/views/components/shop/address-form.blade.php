<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <x-jet-form-section submit="addNewAddress">
        <x-slot name="title">
            {{ __('Add new address') }}
        </x-slot>

        <x-slot name="description">
            {{ __('Add new address from here') }}
        </x-slot>

        <x-slot name="form">
            <div class="grid grid-cols-6 gap-6 col-span-6" x-data="formAddress()" x-init>
                <!-- Contact -->
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="contact" value="Contact" />
                    <x-jet-input id="contact" class="block mt-1 w-full" type="number" name="contact"
                        wire:model.defer="state.contact" />
                    <x-jet-input-error for="state.contact" class="mt-2" />
                </div>

                <!-- Address -->
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="address" value="Address" />
                    <x-jet-input id="address" class="block mt-1 w-full" type="text" name="address"
                        wire:model.defer="state.address" autocomplete="address" />
                    <x-jet-input-error for="state.address" class="mt-2" />
                </div>

                <!-- State & City Picker -->
                <div class="col-span-6 sm:col-span-4">
                    <div>
                        <x-jet-label for="state" value="State" />
                        <select wire:model.defer='state.state' x-model="state" name="state" id="state"
                            class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full">

                            <option value="">-- Select State --</option>
                            <template x-for="eachState in Object.keys(statesData)" :key="eachState">
                                <option :value="eachState" :selected='eachState === state' x-text="eachState">
                                </option>
                            </template>
                        </select>
                        <x-jet-input-error for="state.state" class="mt-2" />
                    </div>
                    <div class="mt-4">
                        <x-jet-label for="city" value="City" />
                        <select id="city" name="city" x-model="city"
                            class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full"
                            wire:model.defer="state.city">
                            <option value="">-- Select City --</option>
                            <template x-for="eachCity in statesData[state]" :key="eachCity">
                                <option :value="eachCity" :selected='eachCity === city' x-text="eachCity">
                                </option>
                            </template>
                        </select>
                        <x-jet-input-error for="state.city" class="mt-2" />
                    </div>
                    <!-- Pin Code -->
                    <div class="col-span-6 sm:col-span-4 mt-4">
                        <x-jet-label for="pin_code" value="{{ __('Pin Code') }}" />
                        <x-jet-input id="pin_code" class="block mt-1 w-full" type="text" name="pin_code"
                            wire:model.defer="state.pin_code" />
                        <x-jet-input-error for="state.pin_code" class="mt-2" />
                    </div>

                    <!-- Shipping Note -->
                    <div class="col-span-6 sm:col-span-4 mt-4">
                        <x-jet-label for="shipping_notes" value="{{ __('Shipping Notes') }}" />
                        <x-jet-input id="shipping_notes" class="block mt-1 w-full" type="text" name="shipping_notes"
                            wire:model.defer="state.shipping_notes" />
                        <x-jet-input-error for="state.shipping_notes" class="mt-2" />
                    </div>
                </div>
            </div>
        </x-slot>

        <x-slot name="actions">
            <x-jet-secondary-button class="mr-2" onclick="history.back()">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Go Back
            </x-jet-secondary-button>
            <x-jet-action-message class="mr-3" on="saved">
                {{ __('Saved.') }}
            </x-jet-action-message>

            <x-jet-button>
                {{ __('Save') }}
            </x-jet-button>
        </x-slot>
    </x-jet-form-section>
</div>
@push('scripts')
    @once
        <script>
            function formAddress() {
                return {
                    state: @entangle('state.state').defer,
                    city: @entangle('state.city').defer,
                    statesData: JSON.parse('{!! json_encode(\App\Constants::STATES_DATA) !!}'),
                };
            }
        </script>
    @endonce
@endpush
