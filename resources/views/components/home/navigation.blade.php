@props(['sections'])

<div
    class="h-20 w-full bg-white dark:bg-gray-900 dark:border-b fixed top-0 shadow-sm flex items-center justify-between py-1 px-6"
>

    <!-- Mobile menu when width is less than 640px -->
    <x-home.navigation.mobile-menu :sections="$sections" />

    <!-- Text for logo -->
    <span class="text-lg md:text-2xl font-bold bg-gradient-to-r from-primary-green to-primary-blue text-transparent bg-clip-text" >
        Tinelli Transportes
    </span >

    <!-- Desktop menu when width is greater than 640px -->
    <x-home.navigation.desktop-menu :sections="$sections" />

    <!-- Dropdown when width is greater than 640px -->
    <x-home.navigation.dropdown />

</div >
