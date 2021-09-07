@extends('layouts.app')

@section('content')
    <div class="flex flex-row space-x-2 p-2">
        <x-partials.admin-nav class="w-64 flex-none" />
        <div class="flex-1 px-8">
            <h2 class="text-xl font-bold py-2 flex items-center border-b border-gray-300 space-x-2">
                @if ($titleIcon ?? false)
                    {{ $titleIcon }}
                @else
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                    </svg>
                @endif
                <span>
                    {{ $title ?? 'Admin Dashboard' }}
                </span>
            </h2>
            {{ $content }}
        </div>
    </div>
@endsection
