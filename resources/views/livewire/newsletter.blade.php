<div >

    <h1
        class="text-4xl text-center text-gray-900 dark:text-zinc-200 mb-16"
    >
        Newsletter
    </h1 >

    <form
        wire:submit="subscribe"
    >

        {{ $this->form }}

        <div class="w-full flex justify-end" >

            <x-filament::button
                type="submit"
                class="h-fit w-full lg:w-fit mt-6 bg-gradient-to-r from-[#7DB563] to-[#02A6A5] text-white hover:from-[#02A6A5] hover:to-[#7DB563] transition duration-150 ease-in-out"
            >
                Inscrever-se
            </x-filament::button >

        </div >
    </form >

</div >
