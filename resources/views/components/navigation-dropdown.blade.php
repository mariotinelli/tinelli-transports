<div class="hidden sm:flex sm:items-center sm:ms-6" >
    <x-dropdown
        align="right"
        width="48"
    >

        <x-slot name="trigger" >

            <div class="relative w-12 h-12 overflow-hidden bg-gray-100 dark:bg-gray-600 rounded-full border transition ease-in-out duration-150 hover:cursor-pointer" >
                <svg class="absolute w-14 h-14 text-gray-400 -left-1"
                     fill="currentColor"
                     viewBox="0 0 20 20"
                     xmlns="http://www.w3.org/2000/svg" >
                    <path fill-rule="evenodd"
                          d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                          clip-rule="evenodd" >
                    </path >
                </svg >
            </div >

        </x-slot >

        <x-slot name="content" >

            <x-dropdown-link :href="route('profile.edit')" >
                {{ __('Profile') }}
            </x-dropdown-link >

            <!-- Authentication -->
            <form method="POST"
                  action="{{ route('logout') }}" >
                @csrf

                <x-dropdown-link :href="route('logout')"
                                 onclick="event.preventDefault();
                                                this.closest('form').submit();" >
                    {{ __('Log Out') }}
                </x-dropdown-link >
            </form >

        </x-slot >

    </x-dropdown >

</div >
