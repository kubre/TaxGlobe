<div>
    <x-jet-label for="state" value="State" />
    <select wire:model='selectedState' name="state" id="state"
        class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full">

        <option value="">-- Select State --</option>
        @foreach ($states as $state)
        <option {{ old('state') == $state ? 'selected' : '' }} value="{{ $state }}">{{ $state }}</option>
        @endforeach
    </select>
    @if (!empty($selectedState))
    <div class="mt-4">
        <x-jet-label for="city" value="City" />
        <select id="city" name="city" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200
    focus:ring-opacity-50 rounded-md shadow-sm w-full">

            <option value="">-- Select City --</option>
            @foreach ($cities as $city)
            <option {{ old('city') == $city ? 'selected' : '' }} value="{{ $city }}">{{ $city }}</option>
            @endforeach
        </select>
    </div>
    @endif
</div>