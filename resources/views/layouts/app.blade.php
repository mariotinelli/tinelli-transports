<!DOCTYPE html>
<html
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    x-data="{ darkMode: false }"
    @toggle-theme.window="darkMode = $event.detail"
    x-cloak
    x-bind:class="{'dark' : darkMode === true}"
    x-init="
        if (!('darkMode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            localStorage.setItem('darkMode', JSON.stringify(true));
        }
        darkMode = JSON.parse(localStorage.getItem('darkMode'));
        $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))
    "
>
<head >
    <meta charset="utf-8" >
    <meta name="viewport"
          content="width=device-width, initial-scale=1" >
    <meta name="csrf-token"
          content="{{ csrf_token() }}" >

    <title >{{ config('app.name', 'Laravel') }}</title >

    <link rel="icon"
          type="image/x-icon"
          href="{{ asset('assets/images/favicons/favicon-32x32.png') }}" >

    <!-- Fonts -->
    <link rel="preconnect"
          href="https://fonts.bunny.net" >
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap"
          rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Livewire -->
    @livewireStyles
</head >
<body
    class="antialiased"
>

<div
    x-data="{ activeSection: null }"
    x-init="
        activeSection = decodeURIComponent(window.location.hash.substring(1));
        $refs[activeSection].scrollIntoView({ top: $refs.resources.scrollHeight, behavior: 'smooth' });
    "
    class="h-screen max-h-screen overflow-hidden bg-white dark:bg-gray-900 flex flex-col justify-between"
>

    <!-- Home - Navbar -->
    <x-home.navigation />

    <!-- Page Content -->
    <main class="mt-[80px] overflow-y-auto max-h-[calc(100%-80px)]" >
        <div class="px-3 md:px-8 lg:px-16 py-6" >
            {{ $slot }}
        </div >

        <!-- Footer -->
        <x-home.footer />
    </main >


</div >

<!-- Livewire -->
@livewireScripts

</body >

</html >
