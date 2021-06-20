@props(['value', 'options', 'default'])

<select {!! $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200
    focus:ring-opacity-50 rounded-md shadow-sm']) !!}>

    @if($default ?? false)
    <option value=''>{{ $default }}</option>
    @endif
    @foreach ($options as $key => $option)
    <option {{ isset($value) ? ($value === $key ? 'selected' : '') : '' }} value="{{ $key }}">{{ $option }}
    </option>
    @endforeach
</select>