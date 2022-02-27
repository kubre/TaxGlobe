<div x-data="{isOpen: {{ $fullPage ? 'false' : 'true' }}, selectedCategory: @entangle('selectedCategory')}"
    class="{{ $fullPage ? 'static' : 'fixed' }} top-28 right-0 lg:static z-10 flex flex-col space-y-1 items-end">
    @push('styles')
        <style>
           
            @media screen and (min-width: {{ $fullPage ? '10px' : '1024px' }} ) {
                .block-important {
                    display: block !important;
                }
            }
        </style>
    @endpush
    <x-jet-secondary-button class="visible {{ $fullPage ? 'hidden' : '' }} lg:hidden rounded-l-xl pl-3 py-2" :isRound="false" variant='secondary'
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
        class="block-important {{ $fullPage ? '' : 'border border-black border-opacity-20'}} lg:border-none bg-white rounded-lg px-4 max-h-80 h-80 py-2 w-full">

        <div class="flex justify-between items-center">
            <strong>Tax Calendar</strong>
            <x-widgets.share align="right" size="h-4 w-4"
                whatsapp="Check the Compliance calendar for the Month of 
                {{ $selectedMonth }}/{{ $selectedYear }} : {{ route('explore.index', [
    'taxMonth' => $selectedMonth,
    'taxYear' => $selectedYear,
    'taxCategory' => $selectedCategory,
]) }}"
                copy="{!! route('explore.index', [
    'taxMonth' => $selectedMonth,
    'taxYear' => $selectedYear,
    'taxCategory' => $selectedCategory,
]) !!}">
            </x-widgets.share>
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
                        <div class="py-2 px-2 bg-indigo-50 rounded-lg mb-1 cursor-pointer"
                            x-on:click='alertBox("{{ $taxDate->title }}", "{{ preg_replace("/\r|\n/", '', nl2br($taxDate->description)) }}")'>
                            <strong
                                class="bg-white rounded-lg p-1 px-2 mr-2">{{ $taxDate->date_at->format('d') }}</strong>
                            <span class="text-gray-500">{{ $taxDate->title }} </span>
                        </div>
                    @elseif ($selectedCategory === 'No Category' && is_null($taxDate->category))
                        <div class="py-2 px-2 bg-indigo-50 rounded-lg mb-1 cursor-pointer"
                            x-on:click='alertBox("{{ $taxDate->title }}", "{{ preg_replace("/\r|\n/", '', nl2br($taxDate->description)) }}")'>
                            <strong
                                class="bg-white rounded-lg p-1 px-2 mr-2">{{ $taxDate->date_at->format('d') }}</strong>
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
