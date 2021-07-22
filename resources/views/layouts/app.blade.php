<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville&family=Nunito:wght@400;600;700&display=swap"
        rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    @livewireStyles

    {{ $head ?? '' }}

    @stack('styles')

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>

<body class="font-sans antialiased">
    <x-jet-banner />

    <div class="min-h-screen bg-gray-200">
        <x-partials.navigation-menu />

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>

        <x-partials.bottom-nav class="block md:hidden" />

        <x-partials.footer class="mb-12 md:mb-0" />
    </div>

    @stack('modals')

    @include('sweetalert::alert')
    @livewireScripts

    @stack('scripts')
</body>

</html>
