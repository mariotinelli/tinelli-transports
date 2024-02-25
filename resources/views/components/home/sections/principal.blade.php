@php
    use Filament\Support\Enums\IconPosition;
    use Filament\Support\Colors\Color;
@endphp

<div
    x-ref="principal"
    id="principal"
    class="h-[calc(100vh-80px)] -mx-3 md:-mx-8 lg:-mx-16 w-[99.6vw] bg-gradient-to-r from-primary-green to-primary-blue flex flex-col items-center px-16"
>

    <div class="flex items-center mt-32" >

        <img
            src="{{ asset('assets/images/logo-contorno-512x512.png') }}"
            alt="Logo"
            class="w-64 h-64"
        />

        <div class="flex flex-col gap-5 px-16 max-w-[70rem]" >

            <h1 class="text-4xl font-bold text-zinc-200"
                style="text-shadow: 2px 2px 4px #000"
            >
                Bem-vindo ao Nosso Sistema de Controle de Abastecimento e Gestão de Frotas
            </h1 >

            <h5 class="text-2xl font-semibold text-zinc-200"
                style="text-shadow: 2px 2px 4px #000"
            >
                Na [Nome da Empresa], apresentamos a solução completa para a eficiente gestão de veículos e controle de
                abastecimento. Nosso sistema é projetado para proporcionar uma abordagem integrada e simplificada,
                capacitando
                empresas a otimizar suas operações e alcançar novos níveis de eficiência.
            </h5 >

        </div >

    </div >

    <div class="flex items-center gap-5 pl-8 mt-16" >

        <a
            href="{{ route('register') }}"
            class="w-48 h-10 bg-transparent border text-white font-semibold rounded-xl flex justify-center items-center gap-2 hover:cursor-pointer hover:bg-gradient-to-r hover:from-primary-green hover:to-primary-blue hover:border-black hover:text-gray-900 dark:hover:text-zinc-200"
        >
            Inscrever-se
            <x-heroicon-o-arrow-right-start-on-rectangle class="w-6 h-6" />
        </a >

        <a
            href="#about"
            @click="$refs.contact.scrollIntoView({ top: $refs.contact.scrollHeight, behavior: 'smooth' });"
            class="w-48 h-10 bg-transparent border text-white font-semibold rounded-xl flex justify-center items-center gap-2 hover:cursor-pointer hover:bg-gradient-to-r hover:from-primary-green hover:to-primary-blue hover:border-black hover:text-gray-900 dark:hover:text-zinc-200"
        >
            Entre em contato
            <x-heroicon-o-inbox-arrow-down class="w-6 h-6" />
        </a >

    </div >

</div >
