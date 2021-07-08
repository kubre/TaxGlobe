<x-jet-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Profile Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your account\'s profile information and email address.') }}
    </x-slot>

    <x-slot name="form">
        <div class="grid grid-cols-6 gap-6 col-span-6"
            x-data="{ profession: '{{ $this->user->profession }}', sameContact: false }">
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

            <!-- Gender -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="gender" value="{{ __('Gender') }}" />
                <x-widgets.select id="gender" class="mt-2 w-full" name="gender"
                :value='$this->user->gender'
                    default='Select Gender' :options="[
                        'Male' => 'Male',
                        'Female' => 'Female',
                        'Transgender' => 'Transgender',
                        'Other' => 'Other',
                    ]" autocomplete="gender">
                </x-widgets.select>
            </div>

            <!-- Profession -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="profession" x-model='profession' value="{{ __('Profession') }}" />
                <x-widgets.select id="profession" class="block mt-1 w-full" name="profession" default='Select Profession' :value='$this->user->profession' :options="[
                    'Professional: CA' => 'Professional: CA',
                    'Professional: CS' => 'Professional: CS',
                    'Professional: CMA' => 'Professional: CMA',
                    'Professional: ADV' => 'Professional: ADV',
                    'Professional: Tax Consultant' => 'Professional: Tax Consultant',
                    'Student: CA' => 'Student: CA',
                    'Student: CS' => 'Student: CS',
                    'Student: CMA' => 'Student: CMA',
                    'Student: ADV' => 'Student: ADV',
                    'Other' => 'Other'
                ]" autocomplete="profession">
                </x-widgets.select>
            </div>

            <!-- Other -->
            <div class="col-span-6 sm:col-span-4" x-show='profession == "Other"'>
                <x-jet-label for="profession_other" value="Specify Profession" />
                <x-jet-input id="profession_other" class="block mt-1 w-full" type="text" name="profession_other"
                    autocomplete="profession" :value="$this->user->profession" />
            </div>

            <!-- Professional Email -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="professional_email" value="Professional Email" />
                <x-jet-input id="professional_email" class="block mt-1 w-full" type="text" name="professional_email"
                    autocomplete="email" :value="$this->user->professional_email" />
            </div>

            <!-- Contact -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="contact" value="Contact" />
                <x-jet-input id="contact" class="block mt-1 w-full" type="number" name="contact" autocomplete="mobile" :value="$this->user->contact" />
            </div>

            <!-- Same Contact -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for='same_contact'>
                    <div class="flex items-center">
                        <x-jet-checkbox name='same_contact' id='same_contact' x-model='sameContact' />
                        <div class="ml-2">Whtasapp Contact &amp; Contact is same</div>
                    </div>
                </x-jet-label>
            </div>

            <!-- Whatsapp Contact -->
            <div class="col-span-6 sm:col-span-4" x-show='!sameContact' x-transition>
                <x-jet-label for="whatsapp_contact" value="Whatsapp Contact" />
                <x-jet-input id="whatsapp_contact" class="block mt-1 w-full" type="number" name="whatsapp_contact"
                 autocomplete="mobile" :value="$this->user->whatasapp_contact" />
            </div>

            <!-- Area of Specilization -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="area" value="Area of Specialisation" />
                <x-widgets.select id="area" class="block mt-1 w-full" name="area" :value="$this->user->area"
                    default='Select Area' :options="[
                    'GST' => 'GST',
                    'Domestic Income Tax' => 'Domestic Income Tax',
                    'International Taxation' => 'International Taxation',
                    'Dubai VAT' => 'Dubai VAT',
                    'Accounting' => 'Accounting',
                    'Project Financing' => 'Project Financing',
                    'Subsidies' => 'Subsidies',
                    'Appeals and Assessment' => 'Appeals and Assessment',
                ]"></x-widgets.select>
            </div>

            <!-- Address -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="address" value="Address" />
                <x-jet-input id="address" class="block mt-1 w-full" type="text"
                    name="address" :value='$this->user->address' autocomplete="address" />
            </div>

            <!-- State & City Picker -->
            <div class="col-span-6 sm:col-span-4">
                <livewire:widgets.state-city-picker />
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
