<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Ordering System') }}</title>

    <link rel="shortcut icon" href="{{ asset('logo/no-bg.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,500;1,600&family=Rubik+Broken+Fax&display=swap" rel="stylesheet">

    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>

    <!-- Scripts -->
    <script {{ asset('js/app.js') }} defer></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-poppins antialiased">
    <div class="relative min-h-screen md:flex" x-data="{ open: true }">
        <!-- Sidebar -->
         <aside :class="{ '-translate-x-full': !open }" class="z-10 bg-white text-black w-64 px-2 py-4 absolute inset-y-0 left-0 md:relative transform md:translate-x-0 transition ease-in-out duration-200">
                <!-- Logo -->
                <div class="flex items-center justify-between">
                    <div class="flex flex-row items-start space-y-2 w-full">
                        <header>
                            <a href="{{ route('admin.dashboard') }}" class="flex items-center justify-center flex-row">
                                <img src="{{ asset('logo/no-bg.png')}}" alt="" class="h-20 w-20">
                                <div class="flex flex-col">
                                    <div>
                                        <h1 class="font-semibold text-2xl tracking-md">Twenty <span class="text-yellow-500">Four<span></h1>
                                    </div>
                                    <div class="ml-4">
                                        <h1 class="font-semibold text-2xl tracking-md"><span class="text-yellow-500">Twenty</span> One</h1>
                                    </div>
                                </div>
                            </a>
                        </header>
                    </div>

                    <button type="button" @click="open = !open" class="sm:hidden inline-flex p-2 items-center justify-center rounded-md text-black hover:bg-blue-700 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="block w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <nav class="flex flex-col mt-10 p-3 gap-3 w-full">
                    <div class="{{ request()->routeIs('admin.dashboard') ? 'bg-gray-200 w-full text-2xl font-md' : 'w-44' }} flex items-center gap-2 rounded-sm h-12">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="{{ request()->routeIs('admin.dashboard') ? '#8B5CF6' : '#000000' }}" viewBox="0 0 24 24" stroke-width="1.5" class="ml-10 w-9 h-9">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                        </svg>
                        <x-side-nav-link href="{{ route('admin.dashboard') }}" :active="request()->routeIs('admin.dashboard')" class="text-lg text-black font-medium mt-1 flex items-start">
                            {{ __('Dashboard')}}
                        </x-side-nav-link>
                    </div>
                </nav>

                <nav class="flex flex-col mt-10 p-3 gap-3 w-full">
                    <div class="{{ request()->routeIs('admin.dashboard') ? 'bg-gray-200 w-full text-2xl font-md' : 'w-44' }} flex items-center gap-2 rounded-sm h-12">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="{{ request()->routeIs('admin.dashboard') ? '#8B5CF6' : '#000000' }}" viewBox="0 0 24 24" stroke-width="1.5" class="ml-10 w-9 h-9">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                        </svg>
                        <x-side-nav-link href="{{ route('cashier.cart') }}" :active="request()->routeIs('cashier.cart')" class="text-lg text-black font-medium mt-1 flex items-start">
                            {{ __('Cart')}}
                        </x-side-nav-link>
                    </div>
                </nav>


                <nav class="flex flex-col mt-10 p-3 gap-3 w-full">
                    <div class="{{ request()->routeIs('admin.inventory') ? 'bg-gray-200 w-full text-2xl font-md' : 'w-44' }} flex items-center gap-2 rounded-sm h-12">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="{{ request()->routeIs('admin.inventory')}}" class="ml-10 h-9 w-9">
                            <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                            <path d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                        </svg>
                           
                        <x-side-nav-link href="{{ route('inventory.index') }}" :active="request()->routeIs('admin.inventory')" class="text-lg text-black font-medium mt-1 flex items-start">
                            {{ __('Inventory')}}
                        </x-side-nav-link>
                    </div>
                </nav>

                <nav class="flex flex-col mt-10 p-3 gap-3 w-full">
                    <div class="{{ request()->routeIs('admin.sales') ? 'bg-gray-200 w-full text-2xl font-md' : 'w-44' }} flex items-center gap-2 rounded-sm h-12">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="{{ request()->routeIs('admin.sales') ? '#8B5CF6' : '#000000'}}" class="ml-10 w-9 h-9">
                            <path fill-rule="evenodd" d="M15.22 6.268a.75.75 0 0 1 .968-.431l5.942 2.28a.75.75 0 0 1 .431.97l-2.28 5.94a.75.75 0 1 1-1.4-.537l1.63-4.251-1.086.484a11.2 11.2 0 0 0-5.45 5.173.75.75 0 0 1-1.199.19L9 12.312l-6.22 6.22a.75.75 0 0 1-1.06-1.061l6.75-6.75a.75.75 0 0 1 1.06 0l3.606 3.606a12.695 12.695 0 0 1 5.68-4.974l1.086-.483-4.251-1.632a.75.75 0 0 1-.432-.97Z" clip-rule="evenodd" />
                        </svg>
                                        
                        <x-side-nav-link href="{{ route('admin.sales') }}" :active="request()->routeIs('admin.sales')" class="text-lg text-black font-medium mt-1 flex items-start">
                            {{ __('Sales Report')}}
                        </x-side-nav-link>
                    </div>
                </nav>

                <nav class="flex flex-col mt-10 p-3 gap-3 w-full">
                    <div class="{{ request()->routeIs('product.index') ? 'bg-gray-200 w-full text-2xl font-md' : 'w-44' }} flex items-center gap-2 rounded-sm h-12">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="{{ request()->routeIs('product.index')}}" class="ml-10 w-9 h-9">
                            <path d="M5.625 3.75a2.625 2.625 0 1 0 0 5.25h12.75a2.625 2.625 0 0 0 0-5.25H5.625ZM3.75 11.25a.75.75 0 0 0 0 1.5h16.5a.75.75 0 0 0 0-1.5H3.75ZM3 15.75a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75a.75.75 0 0 1-.75-.75ZM3.75 18.75a.75.75 0 0 0 0 1.5h16.5a.75.75 0 0 0 0-1.5H3.75Z" />
                        </svg>
                        <x-side-nav-link href="{{ route('product.index') }}" :active="request()->routeIs('product.index')" class="text-lg text-black font-medium mt-1 flex items-start">
                            {{ __('Product Display')}}
                        </x-side-nav-link>
                    </div>
                </nav>


                <nav class="flex flex-col mt-10 p-3 gap-3 w-full">
                    <div class="{{ request()->routeIs('admin.manageUser') ? 'bg-gray-200 w-full text-2xl font-md' : 'w-44' }} flex items-center gap-2 rounded-sm h-12">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="{{ request()->routeIs('admin.dashboard') ? '#8B5CF6' : '#000000' }}" viewBox="0 0 24 24" stroke-width="1.5" class="ml-10 w-9 h-9">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                        </svg>
                        <x-side-nav-link href="{{ route('admin.manageUser') }}" :active="request()->routeIs('admin.manageUser')" class="text-lg text-black font-medium mt-1 flex items-start">
                            {{ __('Manage User')}}
                        </x-side-nav-link>
                    </div>
                </nav>
            </aside>
        <!-- Main -->
        <main class="flex-1 h-screen w-full overflow-y-auto rounded-l-md">
            <!-- Top Navigation -->
            <nav class="">
                <div class="mx-auto px-2 sm:px-6 lg:px-8">
                    <div class="relative flex items-center justify-between h-16">
                        <!-- User Dropdown -->
                        <div class="sm:flex flex items-center justify-center sm:items-center absolute inset-y-0 right-0">
                            <div x-data="{ open: false }" class="relative flex items-center">
                                <!-- Profile Dropdown -->
                                <div x-data="{ open: false }" class="relative ms-4 flex flex-row items-center justify-evenly w-48">
                                    <button @click="open = !open" class="relative inline-flex items-center px-3 py-2 border border-transparent text-md leading-4 font-lg rounded-md text-black-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                        <div class="flex items-center justify-end w-20">
                                            <div class="flex">
                                                @if(Auth::user()->photo)
                                                <img class="w-10 h-10 rounded-full ml-2 border-solid border-2 border-sky-500" src="{{ asset(Auth::user()->photo) }}" alt="Profile Image">
                                                @endif
                                            </div>
                                            <div class="ms-1 mt-1">
                                                <svg class="fill-current h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </div>
                                    </button>
                                    <!-- Dropdown Menu -->
                                    <div x-show="open" @click.away="open = false" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 sm:w-48 sm:top-full sm:mt-1 sm:ml-6 z-50">
                                        <div class="py-1">
                                            <x-dropdown-link :href="route('admin-profile.edit')">
                                                {{ __('Edit Profile') }}
                                            </x-dropdown-link>
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();this.closest('form').submit();">
                                                    {{ __('Log Out') }}
                                                </x-dropdown-link>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Main Content -->
            <div class="flex flex-col md:flex-row w-full md:h-full md:gap-2">
                <div class="flex-1">
                    <div class="mx-auto px-2 sm:px-6 lg:px-8">
                        <div class="relative bg-white overflow-hidden shadow">
                            {{ $slot }}
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            
        });
    </script>
    @stack('scripts')
</body>
</html>