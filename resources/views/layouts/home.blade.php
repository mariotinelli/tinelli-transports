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

    <style >
        [x-cloak] {
            display: none !important;
        }
    </style >

    <link rel="icon"
          type="image/x-icon"
          href="{{ asset('assets/images/favicons/favicon-32x32.png') }}" >

    <!-- Fonts -->
    <link rel="preconnect"
          href="https://fonts.bunny.net" >
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap"
          rel="stylesheet" />

    <!-- Livewire -->
    @livewireStyles
    @filamentStyles
    @vite('resources/css/app.css')
</head >

<body
    class="antialiased"
>

@livewire('notifications')

<livewire:home />

<!-- Livewire -->
@livewireScripts

@filamentScripts
@vite('resources/js/app.js')

</body >

</html >
