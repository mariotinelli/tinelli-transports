<div class="w-full max-w-[70rem] border rounded-2xl p-16 shadow-sm dark:bg-gray-800" >

    <h1
        class="text-4xl text-center text-gray-900 dark:text-zinc-200 mb-16"
    >
        Contato
    </h1 >

    <form wire:submit="send" >

        {{ $this->form }}

        <x-filament::button
            type="submit"
            class="w-full mt-6 bg-gradient-to-r from-[#7DB563] to-[#02A6A5] text-white hover:from-[#02A6A5] hover:to-[#7DB563] transition duration-150 ease-in-out"
        >
            Enviar
        </x-filament::button >

    </form >

</div >
