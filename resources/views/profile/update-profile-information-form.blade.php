<x-jet-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Profile Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your account\'s profile information and email address.') }}
    </x-slot>

    <x-slot name="form">
        <div class="grid grid-cols-6 gap-6 col-span-6" x-data="updateProfileData()">
            <!-- Profile Photo -->
            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                    <!-- Profile Photo File Input -->
                    <input type="file" class="hidden" wire:model="photo" x-ref="photo" x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                    <x-jet-label for="photo" value="{{ __('Photo') }}" />

                    <!-- Current Profile Photo -->
                    <div class="mt-2" x-show="! photoPreview">
                        <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}"
                            class="rounded-full h-20 w-20 object-cover">
                    </div>

                    <!-- New Profile Photo Preview -->
                    <div class="mt-2" x-show="photoPreview">
                        <span class="block rounded-full w-20 h-20"
                            x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                        </span>
                    </div>

                    <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                        {{ __('Select A New Photo') }}
                    </x-jet-secondary-button>

                    @if ($this->user->profile_photo_path)
                        <x-jet-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                            {{ __('Remove Photo') }}
                        </x-jet-secondary-button>
                    @endif

                    <x-jet-input-error for="photo" class="mt-2" />
                </div>
            @endif

            <!-- Name -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="state.name"
                    autocomplete="name" />
                <x-jet-input-error for="name" class="mt-2" />
            </div>

            <!-- Email -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="state.email" />
                <x-jet-input-error for="email" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="bio" value="{{ __('Bio') }}" />
                <x-jet-input id="bio" type="text" class="mt-1 block w-full" wire:model.defer="state.bio"
                    autocomplete="bio" />
                <x-jet-input-error for="bio" class="mt-2" />
            </div>

            <!-- Gender -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="gender" value="{{ __('Gender') }}" />
                <x-widgets.select id="gender" class="mt-2 w-full" name="gender" wire:model.defer="state.gender"
                    default='Select Gender' :options="[
                        'Male' => 'Male',
                        'Female' => 'Female',
                        'Transgender' => 'Transgender',
                        'Other' => 'Other',
                    ]">
                </x-widgets.select>
            </div>

            <!-- Profession -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="profession" value="{{ __('Profession') }}" />
                <x-widgets.select id="profession" class="block mt-1 w-full" name="profession"
                    @change='verifyProfession()' x-model="profession" :options="[
                    '' => 'Other',
                    'Professional: CA' => 'Professional: CA',
                    'Professional: CS' => 'Professional: CS',
                    'Professional: CMA' => 'Professional: CMA',
                    'Professional: ADV' => 'Professional: ADV',
                    'Professional: Tax Consultant' => 'Professional: Tax Consultant',
                    'Student: CA' => 'Student: CA',
                    'Student: CS' => 'Student: CS',
                    'Student: CMA' => 'Student: CMA',
                    'Student: ADV' => 'Student: ADV',
                ]">
                </x-widgets.select>
            </div>

            <!-- Other -->
            <div class="col-span-6 sm:col-span-4" x-show='!isProfessionListed(profession)'>
                <x-jet-label for="profession_other" value="Specify Profession" />
                <x-jet-input id="profession_other" class="block mt-1 w-full" type="text" name="profession_other" x-model.lazy='profession'
                    wire:model.defer="state.profession_other" />
            </div>

            <!-- Professional Email -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="professional_email" value="Professional Email" />
                <x-jet-input id="professional_email" class="block mt-1 w-full" type="text" name="professional_email"
                    wire:model.defer="state.professional_email" />
            </div>

            <!-- Contact -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="contact" value="Contact" />
                <x-jet-input id="contact" class="block mt-1 w-full" type="number" name="contact"
                    wire:model.defer="state.contact" />
            </div>

            <!-- Same Contact -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for='same_contact'>
                    <div class="flex items-center">
                        <x-jet-checkbox name='same_contact' id='same_contact' x-model='sameContact'
                            wire:model.defer='state.same_contact' />
                        <div class="ml-2">Whtasapp Contact &amp; Contact is same</div>
                    </div>
                </x-jet-label>
            </div>

            <!-- Whatsapp Contact -->
            <div class="col-span-6 sm:col-span-4" x-show='!sameContact' x-transition>
                <x-jet-label for="whatsapp_contact" value="Whatsapp Contact" />
                <x-jet-input id="whatsapp_contact" class="block mt-1 w-full" type="number" name="whatsapp_contact"
                    wire:model.defer="state.whatsapp_contact" />
            </div>

            <!-- Area of Specilization -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="area" value="Area of Specialisation" />
                <x-jet-input id="area" class="block mt-1 w-full" type="text" name="area"
                    wire:model.defer="state.area" />
                <span class="text-gray-500 text-sm">Seprate using "<strong class="text-gray-900">,</strong>" if
                    multiple</span>
            </div>

            <!-- Address -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="address" value="Address" />
                <x-jet-input id="address" class="block mt-1 w-full" type="text" name="address"
                    wire:model.defer="state.address" autocomplete="address" />
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
                </div>
            </div>
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
@push('scripts')
    @once
        <script>
            function updateProfileData() {
                return {
                    init: function() {
                        this.verifyProfession();
                    },
                    profession: @entangle('state.profession').defer,
                    sameContact: false,
                    state: @entangle('state.state').defer,
                    city: @entangle('state.city').defer,
                    statesData: JSON.parse('{!! json_encode(\App\Constants::STATES_DATA) !!}'),
                    verifyProfession: function() {
                        return this.profession = this.isProfessionListed(this.profession) ? this.profession : '';
                    },
                    isProfessionListed: function(profession) {
                        return [
                            'Professional: CA',
                            'Professional: CS',
                            'Professional: CMA',
                            'Professional: ADV',
                            'Professional: Tax Consultant',
                            'Student: CA',
                            'Student: CS',
                            'Student: CMA',
                            'Student: ADV',
                        ].includes(profession);
                    }
                };
            }
        </script>
    @endonce
@endpush
