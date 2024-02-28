<div
    x-data="{
        activeSection: null,
        showScrollTop: true,
    }"
    x-init="

        const main = document.getElementById('main');

        main.addEventListener('scroll', () => {
            $dispatch('scroll');
        });

        activeSection = decodeURIComponent(window.location.hash.substring(1));

        if (activeSection) {
            $refs[activeSection].scrollIntoView({ top: $refs[activeSection].scrollHeight, behavior: 'smooth' });
        }

        showScrollTop = main.scrollTop > 50 || activeSection ? true : false;
    "
    @scroll.window="showScrollTop = (document.getElementById('main').scrollTop > 100) ? true : false"
    class="h-screen max-h-screen overflow-hidden bg-white dark:bg-gray-900 flex flex-col justify-between"
>

    <!-- Home - Navbar -->
    <x-home.navigation
        :sections="$sections"
    />

    <!-- Page Content -->
    <main
        id="main"
        class="mt-[80px] overflow-y-auto max-h-[calc(100%-80px)]"
    >

        <div class="px-3 md:px-8 lg:px-16 pb-6 w-full" >

            @foreach($sections as $section)

                <x-dynamic-component
                    :component="'home.sections.'.$section['component']"
                />

            @endforeach

        </div >

        <!-- Footer -->
        <x-home.footer />


        <div
            @click="
                document.getElementById('main').scrollTo({ top: 0, behavior: 'smooth' });
                var novaURL = window.location.protocol + '//' + window.location.host + window.location.pathname;
                window.history.replaceState({}, document.title, novaURL);
            "
            x-show="showScrollTop"
            class="absolute rounded-full bottom-3 right-3 bg-primary-blue border p-2 hover:cursor-pointer"
        >

            <x-heroicon-o-arrow-up class="w-6 h-6 text-gray-700 dark:text-zinc-200" />

        </div >
    </main >

</div >
