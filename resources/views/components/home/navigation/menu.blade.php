<div
    class="flex items-center justify-center gap-5 text-gray-900 dark:text-zinc-200"
>


    <a
        href="#resources"
        class="hover:cursor-pointer"
        @click="$refs.resources.scrollIntoView({ top: $refs.resources.scrollHeight, behavior: 'smooth' })"
    >
        Recursos
    </a >

    <a
        href="#benefits"
        class="hover:cursor-pointer"
        @click="$refs.benefits.scrollIntoView({ top: $refs.benefits.scrollHeight, behavior: 'smooth' })"
    >
        Benefícios
    </a >

    <a
        href="#about"
        class="hover:cursor-pointer"
        @click="$refs.about.scrollIntoView({ top: $refs.about.scrollHeight, behavior: 'smooth' })"
    >
        Sobre
    </a >

    <a
        href="#whoWeAre"
        class="hover:cursor-pointer"
        @click="$refs.whoWeAre.scrollIntoView({ top: $refs.whoWeAre.scrollHeight, behavior: 'smooth' })"
    >
        Quem somos
    </a >

    <a
        href="#contact"
        class="hover:cursor-pointer"
        @click="$refs.contact.scrollIntoView({ top: $refs.contact.scrollHeight, behavior: 'smooth' })"
    >
        Contato
    </a >

</div >
