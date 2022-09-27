<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Canasta - Adulto mayor') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    @livewireStyles

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
    <script src="https://kit.fontawesome.com/860d5b4aa4.js" crossorigin="anonymous"></script>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    @livewireScripts

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <x-livewire-alert::scripts />


    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>

</head>

<body class="font-sans" style="all: unset;">

    <!-- component -->
    <div class="md:flex flex-col md:flex-row md:min-h-screen w-full" x-data="{ openMenu: false }">
        <div @click.away="open = false" x-show="openMenu" x-transition:enter="transition ease-in duration-100"
            x-transition:enter-start="transform opacity-0 scale-95"
            x-transition:enter-end="transform opacity-100 scale-100"
            x-transition:leave="transition ease-in-out duration-75"
            x-transition:leave-start="transform opacity-100 scale-100"
            x-transition:leave-end="transform opacity-0 scale-95"
            class="flex flex-col w-full md:w-72 text-gray-700 bg-white dark-mode:text-gray-200 dark-mode:bg-primary-800 flex-shrink-0"
            x-data="{ open: false }">

            <div class="flex justify-center">
                <a href="{{ route('dashboard') }}"
                    class="text-xl font-semibold tracking-widest text-primary-500 rounded-lg dark-mode:text-white focus:outline-none focus:shadow-outline">
                    <img class="object-center object-fill h-36 w-96 -m-4"
                        src="{{ asset('/images/logo-gobernacion.svg') }}" alt="">
                </a>
            </div>

            {{-- <div class="flex-shrink-0 px-8 py-4 flex flex-row items-center justify-between">

                <a href="{{ route('dashboard') }}"
                    class="text-xl font-semibold tracking-widest text-primary-500 rounded-lg dark-mode:text-white focus:outline-none focus:shadow-outline">
                    <i class="fa-solid fa-basket-shopping"></i> Canastas</a>

            </div> --}}

            <nav class="flex-grow md:block px-4 pb-4 md:pb-0 md:overflow-y-auto">

                {{-- <x-a-sidenav href="{{ route('category.dashboard') }}"
                    :active="request()->routeIs('category.dashboard') || request()->routeIs('category.create') || request()->routeIs('category.update')">
                    {{ __('menu.category') }}
                </x-a-sidenav> --}}

                {{-- Options Admin Reader --}}
                {{-- @if (Auth::user()->hasAnyRole(['admin', 'reader']))
                @endif --}}

                {{-- Options Admin --}}
                {{-- @if (Auth::user()->hasRole('admin'))
                @endif --}}

                {{-- <x-a-sidenav href="{{ route('sale.table') }}" :active="request()->routeIs('sale.table')">
                    {{ __('menu.sale') }}
                </x-a-sidenav> --}}

                {{-- <x-a-sidenav href="{{ route('setting.update', 'setting') }}"
                    :active="request()->routeIs('setting.dashboard') || request()->routeIs('setting.update')">
                    {{ __('menu.setting') }}
                </x-a-sidenav> --}}

                {{-- @if (Auth::user()->hasRole('admin')) --}}

                {{-- SUPER ADMIN --}}

                @if (Auth::user()->hasAnyRole(['superadmin', 'admin', 'user']))
                    {{-- start settings --}}
                    <div @click.away="open = false" class="relative z-10" x-data="{ open: false }">
                        <a @click="open = !open"
                            class="flex flex-row items-center content-between w-full px-4 py-2 mt-2 text-gray-500  text-sm font-semibold text-left bg-transparent rounded-full dark-mode:bg-transparent dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:focus:bg-primary-600 dark-mode:hover:bg-primary-600 md:block hover:text-primary-700 focus:text-primary-700 hover:bg-primary-200 ">
                            <div class="w-full flex justify-between ">
                                <div class="flex space-x-2 ">

                                    <div class="flex h-full items-center ">
                                        <span class="inline-block align-middle"><i class="fa-solid fa-house"></i>
                                            Administración</span>
                                    </div>

                                </div>
                                <div class="flex space-x-2 ">
                                    <div class="flex h-full justify-center items-center">
                                        <svg fill="currentColor" viewBox="0 0 20 20"
                                            :class="{ 'rotate-180': open, 'rotate-0': !open }"
                                            class="w-6 h-6 transition-transform duration-200 transform">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <div x-show="open" x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            class=" right-0 w-full mt-2 origin-top-right rounded-md shadow-lg">
                            <div class="px-2 py-2 bg-white rounded-md shadow dark-mode:bg-primary-800">
                                @if (Auth::user()->hasAnyRole(['superadmin', 'admin']))
                                    <x-a-sidenav
                                        href="{{ route('setting.update', '5db32257-0105-46f6-8519-9759ea997cde') }}"
                                        :active="request()->routeIs(
                                            'setting.update',
                                            '5db32257-0105-46f6-8519-9759ea997cde',
                                        ) ||
                                            request()->routeIs(
                                                'setting.update',
                                                '5db32257-0105-46f6-8519-9759ea997cde',
                                            ) ||
                                            request()->routeIs(
                                                'setting.update',
                                                '5db32257-0105-46f6-8519-9759ea997cde',
                                            )">
                                        <i class="fa-solid fa-gear"></i></i> Configuración
                                    </x-a-sidenav>
                                @endif



                                <x-a-sidenav href="{{ route('user.dashboard') }}" :active="request()->routeIs('user.dashboard') ||
                                    request()->routeIs('user.create') ||
                                    request()->routeIs('user.update')">
                                    <i class="fa-solid fa-user"></i> Usuarios
                                </x-a-sidenav>
                                <hr class="my-2">

                            </div>
                        </div>
                    </div>
                    {{-- end settings --}}
                @endif
                {{-- END SUPER ADMIN --}}

               
                
                <hr class=" my-2">
                {{-- profile options --}}
                <div @click.away="open = false" class="relative z-30" x-data="{ open: false }">
                    <a @click="open = !open"
                        class="flex flex-row items-center content-between w-full px-4 py-2 mt-2 text-gray-500  text-sm font-semibold text-left bg-transparent rounded-full dark-mode:bg-transparent dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:focus:bg-primary-600 dark-mode:hover:bg-primary-600 md:block hover:text-primary-700 focus:text-primary-700 hover:bg-primary-200 ">
                        <div class="w-full flex justify-between ">
                            <div class="flex space-x-2 ">

                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                    <div
                                        class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                                        <img class="h-8 w-8 rounded-full object-cover"
                                            src="{{ Auth::user()->profile_photo_url }}"
                                            alt="{{ Auth::user()->fullname }}" />
                                    </div>
                                    <div class="flex h-full justify-center items-center ">
                                        <span class="inline-block align-middle">{{ Auth::user()->fullname }}</span>
                                    </div>
                                @else
                                    <div
                                        class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">

                                        <svg class="h-8 w-8" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div class="flex h-full justify-center items-center ">
                                        <span class="inline-block align-middle">{{ Auth::user()->email }}</span>
                                    </div>
                                @endif

                            </div>
                            <div class="flex space-x-2 ">
                                <div class="flex h-full justify-center items-center">
                                    <svg fill="currentColor" viewBox="0 0 20 20"
                                        :class="{ 'rotate-180': open, 'rotate-0': !open }"
                                        class="w-6 h-6 transition-transform duration-200 transform">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </div>

                        </div>
                    </a>
                    <div x-show="open" x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="absolute right-0 w-full mt-2 origin-top-right rounded-md shadow-lg">
                        <div class="px-2 py-2 bg-white rounded-md shadow dark-mode:bg-primary-800">

                            <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-full dark-mode:bg-transparent dark-mode:hover:bg-primary-600 dark-mode:focus:bg-primary-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-primary-700 focus:text-primary-700 hover:bg-primary-200 "
                                href="{{ route('profile.show') }}">Perfil</a>

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-full dark-mode:bg-transparent dark-mode:hover:bg-primary-600 dark-mode:focus:bg-primary-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-primary-700 focus:text-primary-700 hover:bg-primary-200 "
                                    href="{{ route('api-tokens.index') }}">API Tokens</a>
                            @endif

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                this.closest('form').submit();"
                                    class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-full dark-mode:bg-transparent dark-mode:hover:bg-primary-600 dark-mode:focus:bg-primary-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-primary-700 focus:text-primary-700 hover:bg-primary-200 "
                                    href="#">Salir</a>
                            </form>

                        </div>
                    </div>
                </div>
                {{-- end profile options --}}

            </nav>
        </div>
        {{-- content dashboard --}}
        <div class="bg-gray-200 w-full min-h-screen">
            {{-- header content --}}
            <div class="w-full px-4 sm:px-6 lg:px-8 bg-white">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="flex items-center justify-center">
                            {{-- icon font awesome burger menu --}}
                            <div class="flex items-center justify-center cursor-pointer text-primary-500 hover:bg-primary-100 w-10 h-10 rounded-full"
                                @click="openMenu = !openMenu">
                                <svg fill="currentColor" viewBox="0 0 20 20" class="w-6 h-6">
                                    <path x-show="!openMenu" fill-rule="evenodd"
                                        d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z"
                                        clip-rule="evenodd"></path>

                                    <path x-show="openMenu" fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            {{-- end icon font awesome burger menu --}}

                            <h1
                                class="inline-flex items-center px-1 pt-1 text-lg font-medium leading-5 text-primary-500 focus:outline-none focus:border-primary-700 transition duration-150 ease-in-out">
                                {{ $header }}

                                <h1>
                        </div>
                    </div>
                </div>
            </div>
            {{-- end header content --}}

            <main>
                {{ $slot }}
            </main>
        </div>
        {{-- content dashboard --}}
    </div>

    @stack('modals')

    <script src="https://cdn.jsdelivr.net/npm/chart.js@latest/dist/Chart.min.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> --}}

    @stack('custom-scripts')

</body>

</html>
