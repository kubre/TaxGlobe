<div x-data="{isOpen: false, selectedCategory: @entangle('selectedCategory')}"
    class="fixed top-32 right-0 lg:static z-10 flex flex-col space-y-1 items-end">
    @push('styles')
        <style>
            @media screen and (min-width: 1024px) {
                .block-important {
                    display: block !important;
                }
            }

        </style>
    @endpush
    <x-jet-secondary-button class="visible lg:hidden rounded-l-xl pl-3 py-2" :isRound="false" variant='secondary'
        x-on:click="isOpen = !isOpen">
        <svg x-show="!isOpen" xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
        </svg>
        <svg x-show="isOpen" xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </x-jet-secondary-button>
    <div x-show="isOpen" x-cloak x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0 transform origin-top-right scale-50"
        x-transition:enter-end="opacity-100 transform origin-top-right scale-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 transform origin-top-right scale-100"
        x-transition:leave-end="opacity-0 transform origin-top-right scale-50"
        class="block-important border border-gray-400 lg:border-0 bg-white rounded-lg px-4 max-h-80 h-80 py-2 w-full">

        <div class="flex justify-between items-center">
            <strong>Tax Calendar</strong>
            <x-jet-dropdown align="left" width="48">
                <x-slot name="trigger">
                    <x-jet-secondary-button variant='white'>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                        </svg>
                    </x-jet-secondary-button>
                </x-slot>

                <x-slot name="content">
                    <x-jet-dropdown-link class="flex items-center"
                        href="https://api.whatsapp.com/send?text={{ urlencode(
    'Check the Compliance calendar for the Month of ' .
        $selectedMonth .
        '/' .
        $selectedYear .
        ': ' .
        route('explore.index', [
            'taxMonth' => $selectedMonth,
            'taxYear' => $selectedYear,
            'taxCategory' => $selectedCategory,
        ]),
) }}"
                        target="_blank" ata-action="share/whatsapp/share">
                        <svg fill="#25D366" class="h-4 w-4 mr-2" role="img" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                        </svg>
                        {{ __('Whatsapp') }}
                    </x-jet-dropdown-link>
                    <x-jet-dropdown-link
                        data-clipboard-text="{{ route('explore.index', [
    'taxMonth' => $selectedMonth,
    'taxYear' => $selectedYear,
    'taxCategory' => $selectedCategory,
]) }}"
                        class="flex items-center copy-link">
                        <svg class="h-4 w-4 mr-2" role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                        </svg>
                        {{ __('Copy Link') }}
                    </x-jet-dropdown-link>
                </x-slot>
            </x-jet-dropdown>
        </div>

        <div class="mt-1">
            <div class="grid grid-cols-2 gap-x-2">
                <x-widgets.select wire:model='selectedYear' :options="$years"></x-widgets.select>
                <x-widgets.select wire:model='selectedMonth' :options="[
                1 => 'Jan',
                2 => 'Feb',
                3 => 'Mar',
                4 => 'Apr',
                5 => 'May',
                6 => 'Jun',
                7 => 'Jul',
                8 => 'Aug',
                9 => 'Sep',
                10 => 'Oct',
                11 => 'Nov',
                12 => 'Dec',
            ]"></x-widgets.select>
            </div>
            <div class="mt-1">
                <x-widgets.select class="w-full" wire:model="selectedCategory" :options="$categoriesInMonth">
                </x-widgets.select>
            </div>
            <div class="pt-2 overflow-y-auto h-44" x-data x-init>
                @forelse ($taxDates as $taxDate)
                    @if ($selectedCategory === 'All' || $selectedCategory === $taxDate->category)
                        <div class="py-1 px-2 bg-gray-300 border border-gray-500 rounded mb-1 cursor-pointer"
                            x-on:click='alertBox("{{ $taxDate->title }}", "{{ preg_replace("/\r|\n/", '', nl2br($taxDate->description)) }}")'>
                            <strong class="bg-gray-100 rounded px-1">{{ $taxDate->date_at->format('d') }}</strong>
                            <span class="text-gray-700">{{ $taxDate->title }} </span>
                        </div>
                    @elseif ($selectedCategory === 'No Category' && is_null($taxDate->category))
                        <div class="py-1 px-2 bg-gray-300 border border-gray-500 rounded mb-1 cursor-pointer"
                            x-on:click='alertBox("{{ $taxDate->title }}", "{{ preg_replace("/\r|\n/", '', nl2br($taxDate->description)) }}")'>
                            <strong class="bg-gray-100 rounded px-1">{{ $taxDate->date_at->format('d') }}</strong>
                            <span class="text-gray-700">{{ $taxDate->title }} </span>
                        </div>
                    @endif
                @empty
                    <div class="p-2">
                        {{ __('No data available') }}
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
