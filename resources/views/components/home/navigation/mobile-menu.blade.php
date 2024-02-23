@props(['sections'])

<div
    x-data="{ open: false }"
    class="flex sm:hidden"
>

    <x-icons.bars-4
        class="text-gray-600 dark:text-zinc-200 cursor-pointer"
        @click="open = true"
    />

    <div
        x-show="open"
        class="absolute h-screen bg-white dark:bg-gray-900 top-0 left-0 w-full text-gray-900 dark:text-zinc-200"
    >

        <!-- Mobile Sidebar Header -->
        <div class="h-20 flex items-center justify-between py-1 px-6 shadow-sm" >
            <x-icons.x-mark
                class="text-gray-600 dark:text-zinc-200 cursor-pointer"
                @click="open = false"
            />

            <span class="text-lg md:text-2xl font-bold bg-gradient-to-r from-[#7DB563] to-[#02A6A5] text-transparent bg-clip-text" >
                Tinelli Transportes
            </span >
        </div >

        <!-- Mobile Sidebar Items -->
        <div class="flex flex-col justify-center gap-3 p-3" >

            <!-- Mobile Sidebar Toggle Theme Item -->
            <x-theme-toggle />

            <hr />

            <!-- Mobile Sidebar User Items -->
            @auth

                <!-- Dashboard -->
                <x-home.navigation.mobile-menu.link :href="route('profile.edit')" >
                    Dashboard
                </x-home.navigation.mobile-menu.link >

                <hr />

                <!-- Logout -->
                <form
                    method="POST"
                    action="{{ route('logout') }}"
                >
                    @csrf

                    <x-home.navigation.mobile-menu.link
                        :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();"
                    >
                        Logout
                    </x-home.navigation.mobile-menu.link >
                </form >

            @endauth

            @guest

                <x-home.navigation.mobile-menu.link :href="route('profile.edit')" >
                    {{ __('Login') }}
                </x-home.navigation.mobile-menu.link >

                <hr />

                <x-home.navigation.mobile-menu.link :href="route('profile.edit')" >
                    {{ __('Cadastro') }}
                </x-home.navigation.mobile-menu.link >

            @endguest

            <!-- Mobile Sidebar Ref Items -->
            <div
                class="w-full flex flex-col sm:hidden items-center justify-center gap-3 text-sm lg:text-lg text-gray-900 dark:text-zinc-200"
            >

                @foreach($sections as $section)

                    <hr class="w-full" />

                    <x-home.navigation.mobile-menu.ref-item
                        :ref="$section['ref']"
                        :text="$section['text']"
                    />

                @endforeach

            </div >

        </div >

    </div >

</div >
