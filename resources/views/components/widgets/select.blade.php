@props(['value', 'options', 'default'])

<select {!! $attributes->merge([
    'class' => 'border-0 border-b border-indigo-200 bg-indigo-50 focus:bg-indigo-100 focus:ouline-none focus:ring-0 rounded-lg',
]) !!}>

    @if ($default ?? false)
        <option value=''>{{ $default }}</option>
    @endif
    @foreach ($options as $key => $option)
        <option {{ isset($value) ? ($value === $key ? 'selected' : '') : '' }} value="{{ $key }}">
            {{ $option }}
        </option>
    @endforeach
</select>
