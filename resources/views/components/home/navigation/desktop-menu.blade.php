@props(['sections'])

<div
    class="hidden sm:flex items-center justify-center gap-2 md:gap-5 text-sm lg:text-lg text-gray-900 dark:text-zinc-200"
>

    @foreach($sections as $section)

        <x-home.navigation.desktop-menu.ref-item
            :ref="$section['ref']"
            :text="$section['text']"
        />

    @endforeach

</div >
