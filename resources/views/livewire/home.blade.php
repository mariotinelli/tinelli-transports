<div
    x-data="{ activeSection: null }"
    x-init="
        activeSection = decodeURIComponent(window.location.hash.substring(1));
        $refs[activeSection].scrollIntoView({ top: $refs.resources.scrollHeight, behavior: 'smooth' });
    "
    class="h-screen max-h-screen overflow-hidden bg-white dark:bg-gray-900 flex flex-col justify-between"
>

    <!-- Home - Navbar -->
    <x-home.navigation
        :sections="$sections"
    />

    <!-- Page Content -->
    <main class="mt-[80px] overflow-y-auto max-h-[calc(100%-80px)]" >

        <div class="px-3 md:px-8 lg:px-16 py-6" >

            @foreach($sections as $section)

                <x-dynamic-component
                    :component="'home.sections.'.$section['ref']"
                />

            @endforeach

        </div >

        <!-- Footer -->
        <x-home.footer />
    </main >

</div >
