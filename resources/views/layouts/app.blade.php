<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-100 text-black flex flex-col p-4">
            <div class="text-lg font-semibold mb-6">
                <a href="{{ route('cashier.cart') }}">{{ config('app.name', 'Laravel') }}</a>
            </div>
            <!-- Navigation Links -->
            <nav class="flex flex-col space-y-2">
                <a href="{{ route('cashier.cart') }}" class="px-4 py-2 rounded hover:bg-gray-700">Menu</a>
                <a href="{{ route('reports.endOfDay', ['date' => now()->toDateString()]) }}"
                    class="px-4 py-2 rounded hover:bg-gray-700">Daily Report</a>
            </nav>


            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('employee.logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('employee.logout')"
                            onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Page Content -->
        <div class="flex-1">
            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main class="p-6">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>

</html>
