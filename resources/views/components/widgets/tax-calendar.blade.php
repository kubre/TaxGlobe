<div class="bg-white rounded-lg px-4 py-2">
    <h4 class="text-lg">Tax Calendar</h4>

    <div class="mt-1">
        <div class="grid grid-cols-2 gap-x-2">
            <x-widgets.select wire:model='selectedYear' :options="$years"></x-widgets.select>
            <x-widgets.select wire:model="selectedMonth" :options="[
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
        <div class="pt-2 overflow-y-auto max-h-80" x-data x-init>
            @forelse ($taxDates as $taxDate)
                <div  class="py-1 px-2 bg-gray-300 border border-gray-500 rounded mb-1 cursor-pointer" @click='alertBox("{{ $taxDate->title }}", "{{ preg_replace( "/\r|\n/", "", nl2br($taxDate->description)) }}")'>
                    <strong class="bg-gray-100 rounded px-1">{{ $taxDate->date_at->format('d') }}</strong>
                    <span class="text-gray-700">{{ $taxDate->title }} </span>
                </div>
            @empty
                <div class="p-2">
                    {{ __('No data available') }}
                </div>
            @endforelse
        </div>
    </div>
</div>
