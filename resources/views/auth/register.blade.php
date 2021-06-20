<x-app-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}"
            x-data="{ profession: '{{ old('profession') }}', sameContact: false, finalForm: false }">
            @csrf

            <div x-show='!finalForm'>
                <div>
                    <x-jet-label for="name" value="{{ __('Name') }}" />
                    <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                        required autofocus autocomplete="name" />
                </div>

                <div class="mt-4">
                    <x-jet-label for="email" value="{{ __('Email') }}" />
                    <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                        required />
                </div>

                <div class="mt-4">
                    <x-jet-label for="username" value="Username" />
                    <x-jet-input id="username" class="block mt-1 w-full" type="text" name="username"
                        :value="old('username')" required autocomplete="username" />
                </div>

                <div class="mt-4">
                    <x-jet-label for="password" value="{{ __('Password') }}" />
                    <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required
                        autocomplete="new-password" />
                </div>

                <div class="mt-4">
                    <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                    <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password"
                        name="password_confirmation" required autocomplete="new-password" />
                </div>

                <div class="mt-4">
                    <x-jet-label for="gender" value="Gender" />
                    <x-widgets.select id="gender" class="block mt-1 w-full" name="gender" :value="old('gender')"
                        default='Select Gender' :options="[
                                            'Male' => 'Male',
                                            'Female' => 'Female',
                                            'Transgender' => 'Transgender',
                                            'Other' => 'Other',
                                        ]" autocomplete="gender"></x-widgets.select>
                </div>

                <div class="mt-4">
                    <x-jet-label for="profession" value="Profession" />
                    <x-widgets.select id="profession" class="block mt-1 w-full" name="profession" x-model='profession'
                        :value="old('profession')" default='Select Profession' :options="[
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
                                        ]" required autocomplete="profession"></x-widgets.select>
                </div>

                <div class="mt-4" x-show='profession == "Other"'>
                    <x-jet-label for="profession_other" value="Specify Profession" />
                    <x-jet-input id="profession_other" class="block mt-1 w-full" type="text" name="profession_other"
                        autocomplete="profession" :value="old('profession_other')" />
                </div>
            </div>

            <div x-show='finalForm' x-transition>
                <div>
                    <h4 class="text-xl">Optional Fields</h4>
                </div>
                <div class="mt-4">
                    <x-jet-label for="professional_email" value="Professional Email" />
                    <x-jet-input id="professional_email" class="block mt-1 w-full" type="text" name="professional_email"
                        autocomplete="email" :value="old('professional_email')" />
                </div>

                <div class="mt-4">
                    <x-jet-label for="contact" value="Contact" />
                    <x-jet-input id="contact" class="block mt-1 w-full" type="number" name="contact"
                        autocomplete="mobile" :value="old('contact')" />
                </div>

                <div class="mt-4">
                    <x-jet-label for='same_contact'>
                        <div class="flex items-center">
                            <x-jet-checkbox name='same_contact' id='same_contact' x-model='sameContact' />
                            <div class="ml-2">Whtasapp Contact &amp; Contact is same</div>
                        </div>
                    </x-jet-label>
                </div>

                <div class="mt-4" x-show='!sameContact' x-transition>
                    <x-jet-label for="whatsapp_contact" value="Whatsapp Contact" />
                    <x-jet-input id="whatsapp_contact" class="block mt-1 w-full" type="number" name="whatsapp_contact"
                        autocomplete="mobile" :value="old('whatasapp_contact')" />
                </div>

                <div class="mt-4">
                    <x-jet-label for="area" value="Area of Specialisation" />
                    <x-widgets.select id="area" class="block mt-1 w-full" name="area" :value="old('area')"
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

                <div class="mt-4">
                    <x-jet-label for="address" value="Address" />
                    <x-jet-input id="address" class="block mt-1 w-full" type="text" name="address"
                        autocomplete="address" />
                </div>

                <div class="mt-4">
                    <livewire:widgets.state-city-picker />
                </div>

                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms" />

                            <div class="ml-2">
                                {!! __(' I agree to the :terms_of_service and :privacy_policy', [ 'terms_of_service'=>
                                '<a target="_blank" href="' . route('terms.show') . '"
                                    class="underline text-sm text-gray-600 hover:text-gray-900">' . __('Terms of
                                    Service') .
                                    '</a>',
                                'privacy_policy' => '<a target="_blank" href="' . route('policy.show') . '"
                                    class="underline text-sm text-gray-600 hover:text-gray-900">' . __('Privacy Policy')
                                    .
                                    '</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
                @endif
            </div>

            <div class="flex items-center justify-end mt-4" x-show='!finalForm' x-transition>
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-jet-button type='button' @click='finalForm = true' class="ml-4">
                    Next
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </x-jet-button>
            </div>
            <div class="flex items-center justify-end mt-4" x-show='finalForm' x-transition>
                <x-jet-secondary-button type='button' @click='finalForm = false' class="ml-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Back
                </x-jet-secondary-button>

                <x-jet-button class="ml-4">
                    {{ __('Register') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>

    <x-slot name="scripts">
        <script>

        </script>
    </x-slot>
</x-app-layout>