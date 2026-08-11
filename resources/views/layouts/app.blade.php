<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'TMS - Temperature Monitoring System') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-slate-950 text-slate-100 min-h-screen">
        <div class="min-h-screen flex flex-col">
            <!-- Sidebar & Mobile Header -->
            <livewire:layout.navigation />

            <!-- Main Content Container with Desktop Left Sidebar Offset -->
            <div class="lg:ps-64 flex-1 flex flex-col">
                <!-- Top Page Header -->
                @if (isset($header))
                    <header class="bg-slate-900/60 border-b border-slate-800/80 backdrop-blur-md sticky top-0 z-30 px-6 py-4">
                        <div class="w-full">
                            {{ $header }}
                        </div>
                    </header>
                @endif

                <!-- Main Body View -->
                <main class="flex-1 p-4 sm:p-6 lg:p-8 w-full">
                    {{ $slot }}
                </main>

                <!-- Footer -->
                <footer class="px-6 py-4 border-t border-slate-800/60 text-xs text-slate-500 text-center">
                    &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
                </footer>
            </div>
        </div>
    </body>
</html>
