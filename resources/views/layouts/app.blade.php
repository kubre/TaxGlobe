<!DOCTYPE html>
<html prefix="og: http://ogp.me/ns#" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

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
            @yield('content')
        </main>

        <x-partials.bottom-nav class="block md:hidden" />
        <div class="py-10 block md:hidden"></div>
    </div>

    @stack('modals')

    @include('sweetalert::alert')
    @livewireScripts

    <script src="{{ asset('js/vendor/clipboard.js') }}"></script>
    <script>
        var clipboard = new ClipboardJS('.copy-link');
        clipboard.on('success', function(e) {
            Toast.fire({
                icon: 'success',
                text: 'Copied link successfully!',
                timer: 1000
            })
        });

        function openImage(url) {
            Swal.fire({
                imageUrl: url,
                imageAlt: 'Post Image',
                showCloseButton: true,
                width: Math.min(600, window.innerWidth),
                confirmButtonText: 'Close'
            });
        }

        function alertBox(title, description) {
            Swal.fire({
                title: title,
                html: description,
                showCloseButton: true,
                width: Math.min(600, window.innerWidth),
                confirmButtonText: 'Close'
            });
        }

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        window.addEventListener('swal', function(e) {
            Swal.fire(e.detail);
        });

        window.addEventListener('toast', function(e) {
            Toast.fire(e.detail);
        });
    </script>
    @stack('scripts')
</body>

</html>
